<?php
namespace Emma;

class Sqepdf{

    public static $pdf_directory = ABSPATH . '/wp-content/pdf/';

    // public static $zip_directory = ABSPATH . '/wp-content/zip/';

    protected static $pdfcrowd_account = ['token'=>'99555153acac1e2a7c89243f7f44e7a4','name'=>'Emma'];

    public static function print_pdf_file()
    {
    
        if ( ! isset( $_POST['verify_of_nonce_field'] ) || 
            ! wp_verify_nonce( $_POST['verify_of_nonce_field'], 'verify_nonce_action' ) ) :
            print 'Sorry, your nonce did not verify.';
            exit;
        endif;

        $slug = $_POST['slug']; 
        $type = isset($_POST['post_type'])?$_POST['post_type']:get_post_type(); 
        $filename = $slug . '.pdf';

        $is_full_pdf = isset($_POST['pull_pdf'])?true:false;
    
        if(! file_exists(self::$pdf_directory) ) mkdir(self::$pdf_directory); // create PDF Directory
        
        $pdffile = self::$pdf_directory . $filename;
        
        $domain = get_site_url();

        $url = $domain .'/'. $type . '/' . $slug .'?mode=print&pullpdf=1';

        if($is_full_pdf)
        {
            $filename = $slug .'-full.pdf';
            $pdffile = self::$pdf_directory . $filename;
            if( file_exists($pdffile) ){
                self::serve_file($pdffile,$filename);
                exit;
            }  
        }
        else
        {
            $filename = $slug .'-custom.pdf';
            $url = $domain .'/'. $type . '/' . $slug .'?mode=print'.self::query_string();
        }
        self::generate_pdf_file($url,$filename, $pdffile,$is_full_pdf);

    }

    public static function query_string()
    {
        $query_string = "";
        if(isset($_POST['profilesections'])):
            $query_string .= "&profilesections=";
            foreach($_POST['profilesections'] as $id){
            $query_string .=$id . ",";
            }
            $query_string = substr($query_string,0,strlen($query_string)-1);
        endif;

        if(isset($_POST['relatedsections'])):
            $query_string .= "&relatedsections=";
            foreach($_POST['relatedsections'] as $id){
                $query_string.=$id.",";
            }
            $query_string = substr($query_string,0,strlen($query_string)-1);
        endif;

        if(isset($_POST['areasections'])):
            $query_string .= "&areasections=";
            foreach($_POST['areasections'] as $id){
            $query_string .=$id . ",";
            }
            $query_string = substr($query_string,0,strlen($query_string)-1);
        endif;

       
        return $query_string;
    }

    
    public static function serve_file($actual_file,$file_dest)
	{
		header("Content-Type: application/pdf");
	    header("Cache-Control: no-cache");
	    header("Accept-Ranges: none");
	    header("Content-Disposition: attachment; filename=\"$file_dest\"");
	  	ob_clean();
	    flush();
	    readfile($actual_file);
    }
    

    public static function generate_pdf_file($url,$filename,$pdffile,$is_full_pdf=true)
    {
        
        $client = new \Pdfcrowd\HtmlToPdfClient(self::$pdfcrowd_account['name'],
												self::$pdfcrowd_account['token']);
		$client->setUseCurl(true); // important

       
       
       while($tries < 5)
		{
			try
			{
				$client->convertUrlToFile( $url, $pdffile);
			}
			catch(\Pdfcrowd\Error $why)
			{
				error_log("PDFCrowd error: {$why}\n"); 
	
	    		// handle the exception here or rethrow and handle it at a higher level
	    		throw $why;
	    		sleep(5);
			}
			$tries++;
        }

         self::serve_file($pdffile,$filename);
        
    }
    public static function barrister_save_post($post_id,$post,$update)
    {

    }

}