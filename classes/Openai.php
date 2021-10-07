<?php

class Openai
{
    private $secret_key = 'sk-ckCerHbXrCSeaf61c9ELvsy2EcUEz0w2SxBCsIeD';



    public function search($file_id, $query,$documents = [], $engine = 'davinci')
    {
        $request_body = [
            "query" => $query,
            "return_metadata" => true
        ];

        if (count($documents) > 0) {
            $request_body["documents"] = $documents;
        }else{
            $request_body["file"] = $file_id;
        }


        $postfields = json_encode($request_body);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.openai.com/v1/engines/" . $engine . "/search",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: ' . 'Bearer ' . $this->secret_key
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "Error #:" . $err;
            exit();
        } else {
            return $response;
        }
    }


}