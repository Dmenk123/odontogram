<?php
class Api_wa extends CI_Controller {
    protected $_ci;
    
    function __construct(){
        $this->_ci = &get_instance();
    }

    public function send()
    {
        $curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://hp.fonnte.com/api/send_message.php",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => array(
			'phone' => '081338332158',
			'type' => 'text',
			'text' => 'hallo kak, kami dari *sofine dentalclinic* \r\n\r\nPendaftaran anda telah kami terima',
			'delay' => '1',
			'schedule' => '0'),
		CURLOPT_HTTPHEADER => array(
			"Authorization: ZiHmvNDvdoEYEcTfqRXQ"
		),
		));

		$response = curl_exec($curl);


		curl_close($curl);
		echo $response;
		sleep(1); #do not delete!
    }

	public function send_message($phone, $text, $token)
    {
        $curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://hp.fonnte.com/api/send_message.php",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => array(
				'phone' => $phone,
				'type' => 'text',
				'text' => $text,
				'delay' => '1',
				'schedule' => '0'),
			CURLOPT_HTTPHEADER => array(
				"Authorization: ".$token
			),
		));

		$response = curl_exec($curl);


		curl_close($curl);
		return $response;
		sleep(1); #do not delete!
    }


	public function statis_coba()
    {
        $curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://hp.fonnte.com/api/send_message.php",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => array(
			'phone' => '081338332158',
			'type' => 'text',
			'text' => 'hallo kak, kami dari *sofine dentalclinic* \r\n\r\nPendaftaran anda telah kami terima',
			'delay' => '1',
			'schedule' => '0'),
		CURLOPT_HTTPHEADER => array(
			"Authorization: ArNM3KQ"
		),
		));

		$response = curl_exec($curl);


		curl_close($curl);
		echo $response;
		sleep(1); #do not delete!
    }
}