<?php
/**
 * TechPros Theme Functions
 * Based on NexaFlow BPO — original styles & fonts 100% preserved.
 * Added: extended Customizer + full headless REST API.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'nexaflow_setup' ) ) {
function nexaflow_setup() {
    load_theme_textdomain( 'techpros', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
    add_theme_support( 'custom-logo', [ 'height' => 60, 'width' => 200, 'flex-height' => true, 'flex-width' => true ] );
    register_nav_menus([ 'primary' => 'Primary Navigation', 'footer' => 'Footer Navigation' ]);
}
}
add_action( 'after_setup_theme', 'nexaflow_setup' );

if ( ! function_exists( 'nexaflow_enqueue' ) ) {
function nexaflow_enqueue() {
    // Original Google Fonts — Syne + DM Sans — unchanged
    wp_enqueue_style( 'nexaflow-fonts', 'https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;600&display=swap', [], null );
    wp_enqueue_style( 'nexaflow-style', get_stylesheet_uri(), ['nexaflow-fonts'], wp_get_theme()->get('Version') );
    wp_enqueue_script( 'nexaflow-main', get_template_directory_uri() . '/js/main.js', [], wp_get_theme()->get('Version'), true );
    wp_localize_script( 'nexaflow-main', 'TechProsAPI', [
        'root'    => esc_url_raw( rest_url() ),
        'nonce'   => wp_create_nonce( 'wp_rest' ),
        'version' => 'techpros/v1',
    ]);
}
}
add_action( 'wp_enqueue_scripts', 'nexaflow_enqueue' );

if ( ! function_exists( 'nexaflow_widgets' ) ) {
function nexaflow_widgets() {
    register_sidebar([ 'name' => 'Footer Col 1', 'id' => 'footer-1', 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h5>', 'after_title' => '</h5>' ]);
}
}
add_action( 'widgets_init', 'nexaflow_widgets' );

if ( ! function_exists( 'nexaflow_register_post_types' ) ) {
function nexaflow_register_post_types() {
    register_post_type( 'service', [
        'labels'       => [ 'name' => 'Services', 'singular_name' => 'Service', 'add_new_item' => 'Add New Service' ],
        'public'       => true, 'has_archive' => true, 'show_in_rest' => true,
        'supports'     => ['title','editor','thumbnail','excerpt','custom-fields'],
        'menu_icon'    => 'dashicons-admin-settings', 'rewrite' => ['slug'=>'services'],
    ]);
    register_post_type( 'testimonial', [
        'labels'       => [ 'name' => 'Testimonials', 'singular_name' => 'Testimonial' ],
        'public'       => true, 'show_in_rest' => true,
        'supports'     => ['title','editor','thumbnail','custom-fields'],
        'menu_icon'    => 'dashicons-format-quote',
    ]);
}
}
add_action( 'init', 'nexaflow_register_post_types' );

if ( ! function_exists( 'nexaflow_register_meta' ) ) {
function nexaflow_register_meta() {
    foreach (['service_icon','service_link_label','service_link_url'] as $f)
        register_post_meta('service', $f, ['show_in_rest'=>true,'single'=>true,'type'=>'string','auth_callback'=>function(){return current_user_can('edit_posts');}]);
    foreach (['testimonial_rating','testimonial_author_name','testimonial_author_role','testimonial_author_company'] as $f)
        register_post_meta('testimonial', $f, ['show_in_rest'=>true,'single'=>true,'type'=>'string','auth_callback'=>function(){return current_user_can('edit_posts');}]);
}
}
add_action( 'init', 'nexaflow_register_meta' );

if ( ! function_exists( 'nexaflow_rest_cors' ) ) {
function nexaflow_rest_cors() {
    $origin = get_theme_mod('headless_frontend_url','*');
    header('Access-Control-Allow-Origin: ' . esc_attr($origin));
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: Authorization, Content-Type, X-WP-Nonce');
}
}
add_action('rest_api_init','nexaflow_rest_cors');

// REST ROUTES
add_action('rest_api_init', function() {
    $ns = 'techpros/v1'; $pub = '__return_true';
    register_rest_route($ns,'/site-options', ['methods'=>'GET','callback'=>'tp_api_site_options','permission_callback'=>$pub]);
    register_rest_route($ns,'/hero',         ['methods'=>'GET','callback'=>'tp_api_hero','permission_callback'=>$pub]);
    register_rest_route($ns,'/stats',        ['methods'=>'GET','callback'=>'tp_api_stats','permission_callback'=>$pub]);
    register_rest_route($ns,'/clients',      ['methods'=>'GET','callback'=>'tp_api_clients','permission_callback'=>$pub]);
    register_rest_route($ns,'/services',     ['methods'=>'GET','callback'=>'tp_api_services','permission_callback'=>$pub]);
    register_rest_route($ns,'/services/(?P<id>\d+)',['methods'=>'GET','callback'=>'tp_api_service_single','permission_callback'=>$pub]);
    register_rest_route($ns,'/testimonials', ['methods'=>'GET','callback'=>'tp_api_testimonials','permission_callback'=>$pub]);
    register_rest_route($ns,'/industries',   ['methods'=>'GET','callback'=>'tp_api_industries','permission_callback'=>$pub]);
    register_rest_route($ns,'/about',        ['methods'=>'GET','callback'=>'tp_api_about','permission_callback'=>$pub]);
    register_rest_route($ns,'/page/home',    ['methods'=>'GET','callback'=>'tp_api_home','permission_callback'=>$pub]);
    register_rest_route($ns,'/contact',      ['methods'=>'POST','callback'=>'tp_api_contact','permission_callback'=>$pub,
        'args'=>['first_name'=>['required'=>true,'sanitize_callback'=>'sanitize_text_field'],'last_name'=>['required'=>true,'sanitize_callback'=>'sanitize_text_field'],'email'=>['required'=>true,'sanitize_callback'=>'sanitize_email','validate_callback'=>'is_email'],'company'=>['sanitize_callback'=>'sanitize_text_field'],'service'=>['sanitize_callback'=>'sanitize_text_field'],'message'=>['sanitize_callback'=>'sanitize_textarea_field']]
    ]);
});

if (!function_exists('tp_api_site_options')) {
function tp_api_site_options() {
    return rest_ensure_response(['site_name'=>get_bloginfo('name'),'site_description'=>get_bloginfo('description'),'site_url'=>get_site_url(),'logo_url'=>has_custom_logo()?wp_get_attachment_image_url(get_theme_mod('custom_logo'),'full'):null,'brand_accent'=>get_theme_mod('brand_accent','#00C2FF'),'brand_primary'=>get_theme_mod('brand_primary','#0A0F2E'),'phone'=>get_theme_mod('contact_phone','+1 800 123 4567'),'email'=>get_theme_mod('contact_email','hello@nexaflow.com'),'address_1'=>get_theme_mod('contact_address_1','New York, NY 10001'),'address_2'=>get_theme_mod('contact_address_2','London, UK'),'social_linkedin'=>get_theme_mod('social_linkedin','#'),'social_twitter'=>get_theme_mod('social_twitter','#'),'social_facebook'=>get_theme_mod('social_facebook','#'),'social_youtube'=>get_theme_mod('social_youtube','#'),'footer_tagline'=>get_theme_mod('footer_tagline','Transforming business operations with intelligent automation, AI-driven insights, and world-class outsourcing solutions.')]);
}
}

if (!function_exists('tp_api_hero')) {
function tp_api_hero() {
    return rest_ensure_response(['badge'=>get_theme_mod('hero_badge','Trusted by 500+ Global Enterprises'),'title_1'=>get_theme_mod('hero_title_1','Intelligent BPO'),'title_2'=>get_theme_mod('hero_title_2','Solutions for'),'title_highlight'=>get_theme_mod('hero_title_highlight','Modern Business'),'description'=>get_theme_mod('hero_desc','We help enterprises streamline operations, reduce costs, and accelerate growth with AI-powered business process outsourcing and digital transformation.'),'cta_1_text'=>get_theme_mod('hero_cta_1_text','Get Started'),'cta_1_url'=>get_theme_mod('hero_cta_1_url','#contact'),'cta_2_text'=>get_theme_mod('hero_cta_2_text','Explore Services'),'cta_2_url'=>get_theme_mod('hero_cta_2_url','#services'),'dashboard_title'=>get_theme_mod('hero_dashboard_title','Operations Dashboard')]);
}
}

if (!function_exists('tp_api_stats')) {
function tp_api_stats() {
    return rest_ensure_response([['number'=>get_theme_mod('stat_clients_num','500+'),'label'=>get_theme_mod('stat_clients_lbl','Clients Worldwide')],['number'=>get_theme_mod('stat_retention_num','98%'),'label'=>get_theme_mod('stat_retention_lbl','Retention Rate')],['number'=>get_theme_mod('stat_cost_num','40%'),'label'=>get_theme_mod('stat_cost_lbl','Cost Reduction')]]);
}
}

if (!function_exists('tp_api_clients')) {
function tp_api_clients() {
    $raw = get_theme_mod('clients_list','Accenture,Deloitte,JPMorgan,Unilever,Microsoft,Samsung,Pfizer,Walmart');
    return rest_ensure_response(array_values(array_filter(array_map('trim',explode(',',$raw)))));
}
}

if (!function_exists('tp_api_services')) {
function tp_api_services() {
    $posts = get_posts(['post_type'=>'service','posts_per_page'=>-1,'orderby'=>'menu_order','post_status'=>'publish']);
    $data=[];
    foreach($posts as $p) $data[]=['id'=>$p->ID,'title'=>$p->post_title,'description'=>$p->post_excerpt?:wp_trim_words(strip_tags($p->post_content),25),'content'=>apply_filters('the_content',$p->post_content),'icon'=>get_post_meta($p->ID,'service_icon',true)?:'🔧','link_label'=>get_post_meta($p->ID,'service_link_label',true)?:'Learn more','link_url'=>get_post_meta($p->ID,'service_link_url',true)?:'#contact','thumbnail'=>get_the_post_thumbnail_url($p->ID,'large'),'slug'=>$p->post_name];
    if(empty($data)) $data=tp_default_services();
    return rest_ensure_response($data);
}
}

if (!function_exists('tp_api_service_single')) {
function tp_api_service_single($req) {
    $p=get_post($req['id']);
    if(!$p||$p->post_type!=='service') return new WP_Error('not_found','Not found',['status'=>404]);
    return rest_ensure_response(['id'=>$p->ID,'title'=>$p->post_title,'description'=>$p->post_excerpt,'content'=>apply_filters('the_content',$p->post_content),'icon'=>get_post_meta($p->ID,'service_icon',true),'thumbnail'=>get_the_post_thumbnail_url($p->ID,'large')]);
}
}

if (!function_exists('tp_api_testimonials')) {
function tp_api_testimonials() {
    $posts=get_posts(['post_type'=>'testimonial','posts_per_page'=>-1,'orderby'=>'menu_order','post_status'=>'publish']);
    $data=[];
    foreach($posts as $p) $data[]=['id'=>$p->ID,'quote'=>$p->post_content,'rating'=>get_post_meta($p->ID,'testimonial_rating',true)?:'5','author_name'=>get_post_meta($p->ID,'testimonial_author_name',true)?:$p->post_title,'author_role'=>get_post_meta($p->ID,'testimonial_author_role',true),'author_company'=>get_post_meta($p->ID,'testimonial_author_company',true),'avatar'=>get_the_post_thumbnail_url($p->ID,'thumbnail')];
    if(empty($data)) $data=tp_default_testimonials();
    return rest_ensure_response($data);
}
}

if (!function_exists('tp_api_industries')) {
function tp_api_industries() {
    $raw=get_theme_mod('industries_json','');
    if($raw){$d=json_decode($raw,true);if(is_array($d)) return rest_ensure_response($d);}
    return rest_ensure_response([['icon'=>'🏦','title'=>'Banking & Finance','description'=>'Risk, compliance, and digital banking'],['icon'=>'🏥','title'=>'Healthcare','description'=>'Patient services, billing & compliance'],['icon'=>'🛒','title'=>'Retail & E-Commerce','description'=>'CX, fulfillment & supply chain'],['icon'=>'✈️','title'=>'Travel & Hospitality','description'=>'Booking, loyalty & support'],['icon'=>'📡','title'=>'Telecom & Media','description'=>'Subscriber services & network ops'],['icon'=>'🏭','title'=>'Manufacturing','description'=>'Supply chain & procurement'],['icon'=>'🏛️','title'=>'Government','description'=>'Citizen services & back-office'],['icon'=>'🎓','title'=>'Education','description'=>'Admissions, LMS & student support']]);
}
}

if (!function_exists('tp_api_about')) {
function tp_api_about() {
    return rest_ensure_response(['label'=>get_theme_mod('about_label','Why NexaFlow'),'title'=>get_theme_mod('about_title',"We're Not Just an Outsourcing Company"),'description'=>get_theme_mod('about_desc',"We're your strategic growth partner."),'years_num'=>get_theme_mod('about_years_num','20+'),'years_lbl'=>get_theme_mod('about_years_lbl','Years of Industry Expertise'),'cta_text'=>get_theme_mod('about_cta_text','Schedule a Discovery Call'),'cta_url'=>get_theme_mod('about_cta_url','#contact'),'features'=>[['icon'=>get_theme_mod('feature_1_icon','🌍'),'title'=>get_theme_mod('feature_1_title','Global Delivery Network'),'desc'=>get_theme_mod('feature_1_desc','32 delivery centers across 18 countries.')],['icon'=>get_theme_mod('feature_2_icon','🔬'),'title'=>get_theme_mod('feature_2_title','Technology-First Approach'),'desc'=>get_theme_mod('feature_2_desc','AI tools driving 40% faster processing.')],['icon'=>get_theme_mod('feature_3_icon','📋'),'title'=>get_theme_mod('feature_3_title','ISO 27001 & SOC 2 Certified'),'desc'=>get_theme_mod('feature_3_desc','Rigorous security across all service lines.')],['icon'=>get_theme_mod('feature_4_icon','📈'),'title'=>get_theme_mod('feature_4_title','Outcome-Based Pricing'),'desc'=>get_theme_mod('feature_4_desc','Pay for results, not headcount.')]]]);
}
}

if (!function_exists('tp_api_contact')) {
function tp_api_contact($req) {
    $to=get_theme_mod('contact_receive_email',get_bloginfo('admin_email'));
    $name=$req->get_param('first_name').' '.$req->get_param('last_name');
    $email=$req->get_param('email');
    $body="Name: {$name}\nEmail: {$email}\nCompany: ".($req->get_param('company')?:'n/a')."\nService: ".($req->get_param('service')?:'n/a')."\n\n".($req->get_param('message')?:'');
    $sent=wp_mail($to,"[TechPros] Enquiry from {$name}",$body,["Reply-To: {$name} <{$email}>"]);
    return $sent ? rest_ensure_response(['success'=>true,'message'=>"Thanks! We'll be in touch within 24 hours."]) : new WP_Error('mail_failed','Could not send.',['status'=>500]);
}
}

if (!function_exists('tp_api_home')) {
function tp_api_home() {
    return rest_ensure_response(['site'=>tp_api_site_options()->get_data(),'hero'=>tp_api_hero()->get_data(),'stats'=>tp_api_stats()->get_data(),'clients'=>tp_api_clients()->get_data(),'services'=>tp_api_services()->get_data(),'about'=>tp_api_about()->get_data(),'industries'=>tp_api_industries()->get_data(),'testimonials'=>tp_api_testimonials()->get_data()]);
}
}

if (!function_exists('nexaflow_headless_redirect')) {
function nexaflow_headless_redirect() {
    if(is_admin()||(defined('REST_REQUEST')&&REST_REQUEST)) return;
    if(get_theme_mod('headless_mode','0')!=='1') return;
    $f=get_theme_mod('headless_frontend_url','');
    if(empty($f)||$f==='*') return;
    wp_redirect(esc_url($f),302); exit;
}
}
add_action('template_redirect','nexaflow_headless_redirect');

if (!function_exists('nexaflow_customize_register')) {
function nexaflow_customize_register($wp_customize) {
    // HERO PANEL
    $wp_customize->add_panel('nexaflow_hero',['title'=>'🏠 Hero Section','priority'=>30]);
    $wp_customize->add_section('nexaflow_hero_content',['title'=>'Hero Content','panel'=>'nexaflow_hero']);
    foreach([['hero_badge','Badge Text','Trusted by 500+ Global Enterprises','text'],['hero_title_1','Title Line 1','Intelligent BPO','text'],['hero_title_2','Title Line 2','Solutions for','text'],['hero_title_highlight','Title Highlight (colored)','Modern Business','text'],['hero_desc','Description','We help enterprises streamline operations, reduce costs, and accelerate growth with AI-powered business process outsourcing and digital transformation.','textarea'],['hero_cta_1_text','Primary CTA Text','Get Started','text'],['hero_cta_1_url','Primary CTA URL','#contact','url'],['hero_cta_2_text','Secondary CTA Text','Explore Services','text'],['hero_cta_2_url','Secondary CTA URL','#services','url'],['hero_dashboard_title','Dashboard Card Title','Operations Dashboard','text']] as [$k,$l,$d,$t]) {
        $san=$t==='url'?'esc_url_raw':($t==='textarea'?'sanitize_textarea_field':'sanitize_text_field');
        $wp_customize->add_setting($k,['default'=>$d,'sanitize_callback'=>$san,'transport'=>'postMessage']);
        $wp_customize->add_control($k,['label'=>$l,'section'=>'nexaflow_hero_content','type'=>$t]);
    }
    // Hero Stats
    $wp_customize->add_section('nexaflow_stats',['title'=>'Hero Stats','panel'=>'nexaflow_hero']);
    foreach([['stat_clients','500+','Clients Worldwide'],['stat_retention','98%','Retention Rate'],['stat_cost','40%','Cost Reduction']] as [$k,$n,$l]) {
        $wp_customize->add_setting("{$k}_num",['default'=>$n,'sanitize_callback'=>'sanitize_text_field']);
        $wp_customize->add_control("{$k}_num",['label'=>"{$l} — Number",'section'=>'nexaflow_stats','type'=>'text']);
        $wp_customize->add_setting("{$k}_lbl",['default'=>$l,'sanitize_callback'=>'sanitize_text_field']);
        $wp_customize->add_control("{$k}_lbl",['label'=>"{$l} — Label",'section'=>'nexaflow_stats','type'=>'text']);
    }
    // ABOUT PANEL
    $wp_customize->add_panel('nexaflow_about_panel',['title'=>'🏢 About Section','priority'=>35]);
    $wp_customize->add_section('nexaflow_about',['title'=>'About Content','panel'=>'nexaflow_about_panel']);
    foreach([['about_label','Section Label','Why NexaFlow','text'],['about_title','Section Title',"We're Not Just an Outsourcing Company",'text'],['about_desc','Description',"We're your strategic growth partner.",'textarea'],['about_years_num','Years Badge Num','20+','text'],['about_years_lbl','Years Badge Label','Years of Industry Expertise','text'],['about_cta_text','CTA Text','Schedule a Discovery Call','text'],['about_cta_url','CTA URL','#contact','url']] as [$k,$l,$d,$t]) {
        $san=$t==='url'?'esc_url_raw':($t==='textarea'?'sanitize_textarea_field':'sanitize_text_field');
        $wp_customize->add_setting($k,['default'=>$d,'sanitize_callback'=>$san]);
        $wp_customize->add_control($k,['label'=>$l,'section'=>'nexaflow_about','type'=>$t]);
    }
    $wp_customize->add_section('nexaflow_features',['title'=>'About — Features','panel'=>'nexaflow_about_panel']);
    $fd=[1=>['🌍','Global Delivery Network','32 delivery centers across 18 countries.'],2=>['🔬','Technology-First Approach','AI tools driving 40% faster processing.'],3=>['📋','ISO 27001 & SOC 2 Certified','Rigorous security across all service lines.'],4=>['📈','Outcome-Based Pricing','Pay for results, not headcount.']];
    for($i=1;$i<=4;$i++) foreach([['icon','Icon',$fd[$i][0],'text'],['title','Title',$fd[$i][1],'text'],['desc','Description',$fd[$i][2],'textarea']] as [$s,$l,$d,$t]) {
        $wp_customize->add_setting("feature_{$i}_{$s}",['default'=>$d,'sanitize_callback'=>$t==='textarea'?'sanitize_textarea_field':'sanitize_text_field']);
        $wp_customize->add_control("feature_{$i}_{$s}",['label'=>"Feature {$i}: {$l}",'section'=>'nexaflow_features','type'=>$t]);
    }
    // CLIENTS
    $wp_customize->add_section('nexaflow_clients',['title'=>'🏷 Client Logos','priority'=>40]);
    $wp_customize->add_setting('clients_list',['default'=>'Accenture,Deloitte,JPMorgan,Unilever,Microsoft,Samsung,Pfizer,Walmart','sanitize_callback'=>'sanitize_text_field']);
    $wp_customize->add_control('clients_list',['label'=>'Client Names (comma-separated)','section'=>'nexaflow_clients','type'=>'textarea']);
    $wp_customize->add_setting('clients_label',['default'=>'Trusted by leading companies worldwide','sanitize_callback'=>'sanitize_text_field']);
    $wp_customize->add_control('clients_label',['label'=>'Bar Label Text','section'=>'nexaflow_clients','type'=>'text']);
    // INDUSTRIES
    $wp_customize->add_section('nexaflow_industries',['title'=>'🏭 Industries','priority'=>42]);
    $wp_customize->add_setting('industries_section_title',['default'=>'Deep Domain Expertise<br>Across Key Verticals','sanitize_callback'=>'wp_kses_post']);
    $wp_customize->add_control('industries_section_title',['label'=>'Section Title (HTML OK)','section'=>'nexaflow_industries','type'=>'text']);
    $wp_customize->add_setting('industries_json',['default'=>'','sanitize_callback'=>'wp_kses_post']);
    $wp_customize->add_control('industries_json',['label'=>'Industries JSON (blank = defaults)','section'=>'nexaflow_industries','type'=>'textarea']);
    // CONTACT
    $wp_customize->add_section('nexaflow_contact_info',['title'=>'📞 Contact Info','priority'=>45]);
    foreach([['contact_phone','Phone','+1 800 123 4567'],['contact_email','Email','hello@nexaflow.com'],['contact_address_1','Address 1','New York, NY 10001'],['contact_address_2','Address 2','London, UK'],['contact_receive_email','Form emails go to',get_bloginfo('admin_email')]] as [$k,$l,$d]) {
        $wp_customize->add_setting($k,['default'=>$d,'sanitize_callback'=>'sanitize_text_field']);
        $wp_customize->add_control($k,['label'=>$l,'section'=>'nexaflow_contact_info','type'=>'text']);
    }
    // SOCIAL
    $wp_customize->add_section('nexaflow_social',['title'=>'🔗 Social Links','priority'=>46]);
    foreach(['linkedin','twitter','facebook','youtube'] as $n) {
        $wp_customize->add_setting("social_{$n}",['default'=>'#','sanitize_callback'=>'esc_url_raw']);
        $wp_customize->add_control("social_{$n}",['label'=>ucfirst($n).' URL','section'=>'nexaflow_social','type'=>'url']);
    }
    // FOOTER
    $wp_customize->add_section('nexaflow_footer',['title'=>'🔻 Footer','priority'=>48]);
    $wp_customize->add_setting('footer_tagline',['default'=>'Transforming business operations with intelligent automation, AI-driven insights, and world-class outsourcing solutions.','sanitize_callback'=>'sanitize_textarea_field']);
    $wp_customize->add_control('footer_tagline',['label'=>'Footer Tagline','section'=>'nexaflow_footer','type'=>'textarea']);
    // BRAND COLORS (original)
    $wp_customize->add_panel('nexaflow_colors',['title'=>'🎨 Brand Colors','priority'=>50]);
    $wp_customize->add_section('nexaflow_brand_colors',['title'=>'Colors','panel'=>'nexaflow_colors']);
    $wp_customize->add_setting('brand_accent',['default'=>'#00C2FF','sanitize_callback'=>'sanitize_hex_color','transport'=>'postMessage']);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'brand_accent',['label'=>'Accent Color','section'=>'nexaflow_brand_colors']));
    $wp_customize->add_setting('brand_primary',['default'=>'#0A0F2E','sanitize_callback'=>'sanitize_hex_color','transport'=>'postMessage']);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'brand_primary',['label'=>'Primary Dark Color','section'=>'nexaflow_brand_colors']));

    // SERVICES SECTION HEADER
    $wp_customize->add_section('nexaflow_services_hdr',['title'=>'🔧 Services Section Header','priority'=>38]);
    foreach([['services_label','Section Label','What We Do','text'],['services_title','Section Title','End-to-End Business<br>Process Solutions','text'],['services_desc','Section Description','From customer experience to back-office operations, we deliver measurable results across every business function.','textarea']] as [$k,$l,$d,$t]) {
        $wp_customize->add_setting($k,['default'=>$d,'sanitize_callback'=>$t==='textarea'?'sanitize_textarea_field':'wp_kses_post']);
        $wp_customize->add_control($k,['label'=>$l,'section'=>'nexaflow_services_hdr','type'=>$t]);
    }
    // CTA SECTION
    $wp_customize->add_section('nexaflow_cta',['title'=>'🚀 CTA Section','priority'=>47]);
    foreach([['cta_label','Label Text','Ready to Transform?','text'],['cta_title','Title','Let\'s Build Your<br>Operational Advantage','text'],['cta_desc','Description','Schedule a free 30-minute consultation with our solutions team.','textarea'],['cta_btn_1_text','Button Text','Get Free Consultation','text'],['cta_btn_1_url','Button URL','#contact','url']] as [$k,$l,$d,$t]) {
        $san=$t==='url'?'esc_url_raw':($t==='textarea'?'sanitize_textarea_field':'wp_kses_post');
        $wp_customize->add_setting($k,['default'=>$d,'sanitize_callback'=>$san]);
        $wp_customize->add_control($k,['label'=>$l,'section'=>'nexaflow_cta','type'=>$t]);
    }
    // TESTIMONIALS SECTION HEADER
    $wp_customize->add_section('nexaflow_testimonials_hdr',['title'=>'💬 Testimonials Section Header','priority'=>43]);
    foreach([['testimonials_title','Section Title','What Our Clients Say','text'],['testimonials_desc','Section Description',"Don\'t take our word for it. Here\'s what business leaders say about working with NexaFlow.",'textarea']] as [$k,$l,$d,$t]) {
        $wp_customize->add_setting($k,['default'=>$d,'sanitize_callback'=>$t==='textarea'?'sanitize_textarea_field':'sanitize_text_field']);
        $wp_customize->add_control($k,['label'=>$l,'section'=>'nexaflow_testimonials_hdr','type'=>$t]);
    }
    // CONTACT SECTION
    $wp_customize->add_section('nexaflow_contact_section',['title'=>'📋 Contact Form Text','priority'=>44]);
    foreach([['contact_title','Form Title','Get in Touch','text'],['contact_subtitle','Form Subtitle','Fill out the form and our team will reach out within 24 hours.','textarea'],['contact_btn_text','Submit Button Text','Send Message','text']] as [$k,$l,$d,$t]) {
        $wp_customize->add_setting($k,['default'=>$d,'sanitize_callback'=>$t==='textarea'?'sanitize_textarea_field':'sanitize_text_field']);
        $wp_customize->add_control($k,['label'=>$l,'section'=>'nexaflow_contact_section','type'=>$t]);
    }
    // HEADLESS CONFIG
    $wp_customize->add_panel('nexaflow_headless',['title'=>'🔌 Headless / API','priority'=>55]);
    $wp_customize->add_section('nexaflow_headless_cfg',['title'=>'Frontend & CORS','panel'=>'nexaflow_headless']);
    $wp_customize->add_setting('headless_frontend_url',['default'=>'*','sanitize_callback'=>'sanitize_text_field']);
    $wp_customize->add_control('headless_frontend_url',['label'=>'Frontend URL (for CORS)','description'=>'e.g. https://techpros.com — use * to allow all','section'=>'nexaflow_headless_cfg','type'=>'text']);
    $wp_customize->add_setting('headless_mode',['default'=>'0','sanitize_callback'=>'sanitize_text_field']);
    $wp_customize->add_control('headless_mode',['label'=>'Pure Headless (redirect all visits to frontend)','section'=>'nexaflow_headless_cfg','type'=>'checkbox']);
}
}
add_action('customize_register','nexaflow_customize_register');

if (!function_exists('nexaflow_customizer_css')) {
function nexaflow_customizer_css() {
    $accent=get_theme_mod('brand_accent','#00C2FF');
    $primary=get_theme_mod('brand_primary','#0A0F2E');
    echo "<style>:root{--color-accent:{$accent};--color-primary:{$primary};}</style>\n";
}
}
add_action('wp_head','nexaflow_customizer_css');

if (!function_exists('nexaflow_hero')) {
function nexaflow_hero($key,$default='') {
    return esc_html(get_theme_mod($key,$default));
}
}

if (!function_exists('tp_admin_notice')) {
function tp_admin_notice() {
    $screen=get_current_screen();
    if(!$screen||!in_array($screen->id,['dashboard','themes'],true)) return;
    $api=esc_url(rest_url('techpros/v1'));
    echo "<div class='notice notice-info is-dismissible'><p><strong>TechPros Headless</strong> — REST API: <code>{$api}</code> | <a href='{$api}/page/home' target='_blank'>View /page/home →</a> | <a href='".admin_url('customize.php')."'>Customizer →</a></p></div>";
}
}
add_action('admin_notices','tp_admin_notice');

if (!function_exists('tp_default_services')) {
function tp_default_services() {
    return [['id'=>0,'icon'=>'🎯','title'=>'Customer Experience','description'=>'Omnichannel support, CX transformation, and loyalty programs.','link_label'=>'Learn more','link_url'=>'#contact','thumbnail'=>null,'slug'=>'customer-experience'],['id'=>0,'icon'=>'💼','title'=>'Finance & Accounting','description'=>'AP/AR automation, financial reporting, reconciliation, and compliance.','link_label'=>'Learn more','link_url'=>'#contact','thumbnail'=>null,'slug'=>'finance-accounting'],['id'=>0,'icon'=>'🤖','title'=>'AI & Automation','description'=>'Intelligent process automation, RPA deployment, and AI-powered workflows.','link_label'=>'Learn more','link_url'=>'#contact','thumbnail'=>null,'slug'=>'ai-automation'],['id'=>0,'icon'=>'📊','title'=>'Data Analytics','description'=>'Advanced analytics, BI dashboards, and predictive models.','link_label'=>'Learn more','link_url'=>'#contact','thumbnail'=>null,'slug'=>'data-analytics'],['id'=>0,'icon'=>'👥','title'=>'HR Outsourcing','description'=>'Payroll, talent acquisition, benefits administration across 50+ countries.','link_label'=>'Learn more','link_url'=>'#contact','thumbnail'=>null,'slug'=>'hr-outsourcing'],['id'=>0,'icon'=>'🔒','title'=>'IT Services','description'=>'Managed IT, cybersecurity, cloud migration, and 24/7 infrastructure support.','link_label'=>'Learn more','link_url'=>'#contact','thumbnail'=>null,'slug'=>'it-services']];
}
}

if (!function_exists('tp_default_testimonials')) {
function tp_default_testimonials() {
    return [['id'=>0,'rating'=>'5','quote'=>'NexaFlow transformed our customer service operations completely. Response time dropped by 60% and CSAT jumped from 74% to 94% within 6 months.','author_name'=>'Sarah Mitchell','author_role'=>'Chief Operations Officer','author_company'=>'FinCorp Global','avatar'=>null],['id'=>0,'rating'=>'5','quote'=>'Their AI automation solution eliminated 70% of our manual data processing tasks. The ROI was evident in the first quarter — a 3.2x return on investment.','author_name'=>'David Chen','author_role'=>'VP of Technology','author_company'=>'RetailMax Inc','avatar'=>null],['id'=>0,'rating'=>'5','quote'=>'Working with NexaFlow felt like having an extension of our own team. They understood our compliance needs deeply and delivered flawlessly.','author_name'=>'Dr. Priya Sharma','author_role'=>'Director of Operations','author_company'=>'MedCare Systems','avatar'=>null]];
}
}

function techpros_add_aos() {

    wp_enqueue_style(
        'aos-css',
        'https://unpkg.com/aos@2.3.4/dist/aos.css',
        [],
        '2.3.4'
    );

    wp_enqueue_script(
        'aos-js',
        'https://unpkg.com/aos@2.3.4/dist/aos.js',
        [],
        '2.3.4',
        true
    );

}
add_action('wp_enqueue_scripts', 'techpros_add_aos');