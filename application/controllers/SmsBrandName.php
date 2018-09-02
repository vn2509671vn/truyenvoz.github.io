<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function sendSMS()
	{
		//Store your XML Request in a variable
	    $input_xml = '<RQST>
	            <name>send_sms_list</name>
	            <REQID>5</REQID>
	            <CONTRACTID>5824</CONTRACTID>
	            <LABELID>61539</LABELID>
	            <TEMPLATEID>243607</TEMPLATEID>
	            <ISTELCOSUB></ISTELCOSUB>
			    <PARAMS>
			    <NUM>0</NUM>
			    <CONTENT>Xin chao anh</CONTENT>
			    </PARAMS>
			    <CONTRACTTYPEID>1</CONTRACTTYPEID>
			    <MAXITEM>0</MAXITEM>
			    <SCHEDULETIME></SCHEDULETIME>
			    <MOBILELIST>84911998992</MOBILELIST>
			    <AGENTID>183</AGENTID>
			    <APIUSER>VIETSCHOOL</APIUSER>
			    <APIPASS>Vnpt@1234</APIPASS>
			    <USERNAME>VIETSCHOOL</USERNAME>
	    </RQST>';
	    
	    $url = "http://113.185.0.35:8888/smsmarketing/api";

        //setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
		// Following line is compulsary to add as it is:
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "xmlRequest=" . $input_xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $data = curl_exec($ch);
        curl_close($ch);

        //convert the XML result into array
        $array_data = json_decode(json_encode(simplexml_load_string($data)), true);

        print_r('<pre>');
        print_r($array_data);
        print_r('</pre>');
	}
}
