<?php 

    class Judge0
    {

        public function getLanguage()
        {

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://judge0-ce.p.rapidapi.com/languages/68',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Host: judge0-ce.p.rapidapi.com',
                'X-RapidAPI-Key: b3652fbcbdmshda75df4059f5114p163113jsn0633156f3705'
            ),
            ));

            $datas = curl_exec($curl);
            if ($datas === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) 
            {
                return null;
            } 
            $datas = json_decode($datas, true);
        
            return $datas;

        }

        public function sendCode($source,$language_id)
        {

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://judge0-ce.p.rapidapi.com/submissions/?base64_encoded=false&source_code="'.urlencode($source).'"&language_id='.$language_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Host: judge0-ce.p.rapidapi.com',
                'X-RapidAPI-Key: b3652fbcbdmshda75df4059f5114p163113jsn0633156f3705'
            ),
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response, true);
            return $response;
        }

        public function getResponse($token){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://judge0-ce.p.rapidapi.com/submissions/'.$token.'?base64_encoded=false&fields=*',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-RapidAPI-Host: judge0-ce.p.rapidapi.com',
                'X-RapidAPI-Key: b3652fbcbdmshda75df4059f5114p163113jsn0633156f3705'
            ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response, true);
            return $response;
        }



    }