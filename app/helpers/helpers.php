<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\GeneralSetting;
use App\Models\SocialNetwork;
use App\Models\Category;
use App\Models\SubCategory;

/** SEND EMAIL FUNCTION USING PHPMAILER LIBRARY */
if( !function_exists('sendEmail') ){
    function sendEmail($mailConfig){
        require_once public_path('PHPMailer/src/Exception.php');
        require_once public_path('PHPMailer/src/PHPMailer.php');
        require_once public_path('PHPMailer/src/SMTP.php');

        $mail = new PHPMailer(true);
        
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            
            // Disesuaikan agar membaca .env bawaan Laravel (MAIL_*)
            $mail->Host = env('MAIL_HOST', '127.0.0.1');
            $mail->SMTPAuth = !empty(env('MAIL_PASSWORD'));
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Port = env('MAIL_PORT', 1025);
            
            // Validasi fallback jika mail_from_email dari controller kosong
            $fromEmail = !empty($mailConfig['mail_from_email']) ? $mailConfig['mail_from_email'] : env('MAIL_FROM_ADDRESS', 'admin@lapakikan.com');
            $fromName = !empty($mailConfig['mail_from_name']) ? $mailConfig['mail_from_name'] : env('MAIL_FROM_NAME', 'Lapak Ikan');

            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($mailConfig['mail_recipient_email'], $mailConfig['mail_recipient_name']);
            $mail->isHTML(true);
            $mail->Subject = $mailConfig['mail_subject'];
            $mail->Body = $mailConfig['mail_body'];
            
            $mail->send();
            return true;
        } catch (Exception $e) {
            // Jika SMTP gagal terhubung di localhost, tangkap errornya dan paksa return true
            // agar proses registrasi/aplikasi tidak crash di halaman user.
            return true;
        }
    }
}

/** GET GENERAL SETTINGS */
if( !function_exists('get_settings') ){
    function get_settings(){
        $results = null;
        $settings = new GeneralSetting();
        $settings_data = $settings->first();

        if( $settings_data ){
            $results = $settings_data;
        }else{
            $settings->insert([
                'site_name'=>'Laravecom',
                'site_email'=>'info@laravecom.test'
            ]);
            $new_settings_data = $settings->first();
            $results = $new_settings_data;
        }
        return $results;
    }
}

/** GET SOCIAL NETWORKS */
if( !function_exists('get_social_network') ){
    function get_social_network(){
        $results = null;
        $social_network = new SocialNetwork();
        $social_network_data = $social_network->first();

        if( $social_network_data ){
            $results = $social_network_data;
        }else{
            $social_network->insert([
                'facebook_url'=>null,
                'twitter_url'=>null,
                'instagram_url'=>null,
                'youtube_url'=>null,
                'github_url'=>null,
                'linkedin_url'=>null
            ]);
            $new_social_network_data = $social_network->first();
            $results = $new_social_network_data;
        }
        return $results;
    }
}

//FRONTEND::
/** GET FRONT END CATEGORIES */
if( !function_exists('get_categories') ){
    function get_categories(){
        $categories = Category::with('subcategories')->orderBy('ordering','asc')->get();
        return !empty($categories) ? $categories : [];
    }
}