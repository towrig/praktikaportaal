<?php

$url = "https://startuplab.ut.ee/admin/api/elements?q.page.path=kalender";

// As we can only get date according to update time not event happening time
// then we this seems to be a good way to be sure that new events are being gathered
// correctlty. IF PROBLEMS RISE CHANGE strtotime value. 
$onemonthback = date("Y-m-d", strtotime("-1 month"));
$requested_url = $url . '&q.element.updated_at.$gt=' . $onemonthback;

function getData($request_url) {
  $curl = curl_init($request_url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
  ]);
  $response = curl_exec($curl);
  curl_close($curl);
  return $response;
}

$events = getData($requested_url);
$events = json_decode($events, true);

// Gather all the elements API URLs to get custom fields:
//  -  kuupaev
//  -  regstart
$urls = array();

foreach ($events as $event => $val) {
  array_push($urls, $val['url']);
}

$eventdata = array();
foreach($urls as $event_url) {
  array_push($eventdata, json_decode(getData($event_url), true));
}

foreach ($eventdata as $event => $data) {
  $event_date = date_create($data["values"]["kuupaev"]);
  $event_date_formatted = date_format($event_date,"d.m");
  if ($data["values"]["kuupaev"] >= date("Y-m-d")) {
      echo "<div class='event-modal'>
              <a class='font-weight-bold text-uppercase' target='_blank' href='" . $data["public_url"] . "'>" 
              . $data["title"] . 
              "<div class='mt-1 font-weight-light'>
                <span class='event-date'>" 
                  . $event_date_formatted . 
                "</span>"
                . $data["values"]["regstart"] .
        "<br>" . $data["values"]["place"].
              "</div>
              </a>
            </div>
            <hr>" ;
  }
  else {
    // Do nothing if event date is less or equal to today
  }
}
