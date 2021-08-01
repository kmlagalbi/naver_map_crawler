<?php

function Curl($url, $post_data, &$header = null) {

    $ch=curl_init();
    // user credencial
    curl_setopt($ch, CURLOPT_USERPWD, "username:passwd");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    // post_data
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    if (!is_null($header)) {
        curl_setopt($ch, CURLOPT_HEADER, true);
    }
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_VERBOSE, true);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);


    $body = null;
    // error
    if (!$response) {
        $body = curl_error($ch);
        // HostNotFound, No route to Host, etc  Network related error
        $http_status = -1;

    } else {
        //parsing http status code
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (!is_null($header)) {
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
        } else {
            $body = $response;
        }
    }
    curl_close($ch);
    return $body;
}

function AutoC($roadAddr) {

    $startNum = 1;
    $addr = $roadAddr;

    $url = "https://pcmap-api.place.naver.com/place/graphql";
    /* -> places*/
    $json = '[{"operationName":"getPlacesList","variables":{"input":{"query":'.'"'.$addr.'"'.',"start":'.$startNum.',"display":50,"adult":true,"spq":false,"queryRank":"","x":"127.1197805","y":"37.503053","deviceType":"pcmap","bounds":"127.1105537;37.4952987;127.1375904;37.5106363"},"isNmap":false,"isBounds":true},"query":"query getPlacesList($input: PlacesInput, $isNmap: Boolean!, $isBounds: Boolean!) {\n  places: places(input: $input) {\n    total\n    items {\n      id\n      name\n      normalizedName\n      category\n      detailCid {\n        c0\n        c1\n        c2\n        c3\n        __typename\n      }\n      categoryCodeList\n      dbType\n      distance\n      roadAddress\n      address\n      commonAddress\n      bookingUrl\n      phone\n      virtualPhone\n      businessHours\n      daysOff\n      imageUrl\n      imageCount\n      x\n      y\n      poiInfo {\n        polyline {\n          shapeKey {\n            id\n            name\n            version\n            __typename\n          }\n          boundary {\n            minX\n            minY\n            maxX\n            maxY\n            __typename\n          }\n          details {\n            totalDistance\n            arrivalAddress\n            departureAddress\n            __typename\n          }\n          __typename\n        }\n        polygon {\n          shapeKey {\n            id\n            name\n            version\n            __typename\n          }\n          boundary {\n            minX\n            minY\n            maxX\n            maxY\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      subwayId\n      markerLabel @include(if: $isNmap) {\n        text\n        style\n        stylePreset\n        __typename\n      }\n      imageMarker @include(if: $isNmap) {\n        marker\n        markerSelected\n        __typename\n      }\n      oilPrice @include(if: $isNmap) {\n        gasoline\n        diesel\n        lpg\n        __typename\n      }\n      isPublicGas\n      isDelivery\n      isTableOrder\n      isPreOrder\n      isTakeOut\n      isCvsDelivery\n      hasBooking\n      naverBookingCategory\n      bookingDisplayName\n      bookingBusinessId\n      bookingVisitId\n      bookingPickupId\n      easyOrder {\n        easyOrderId\n        easyOrderCid\n        businessHours {\n          weekday {\n            start\n            end\n            __typename\n          }\n          weekend {\n            start\n            end\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      baemin {\n        businessHours {\n          deliveryTime {\n            start\n            end\n            __typename\n          }\n          closeDate {\n            start\n            end\n            __typename\n          }\n          temporaryCloseDate {\n            start\n            end\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      yogiyo {\n        businessHours {\n          actualDeliveryTime {\n            start\n            end\n            __typename\n          }\n          bizHours {\n            start\n            end\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      isPollingStation\n      hasNPay\n      talktalkUrl\n      visitorReviewCount\n      visitorReviewScore\n      blogCafeReviewCount\n      bookingReviewCount\n      streetPanorama {\n        id\n        pan\n        tilt\n        lat\n        lon\n        __typename\n      }\n      naverBookingHubId\n      bookingHubUrl\n      bookingHubButtonName\n      __typename\n    }\n    optionsForMap @include(if: $isBounds) {\n      maxZoom\n      minZoom\n      includeMyLocation\n      maxIncludePoiCount\n      center\n      displayCorrectAnswer\n      correctAnswerPlaceId\n      spotId\n      __typename\n    }\n    __typename\n  }\n}\n"}]';
    //$json = '[{"operationName":"getPlacesList","variables":{"input":{"query":'.'"'.$addr.'"'.',"start":'.$startNum.',"display":50,"adult":false,"spq":false,"queryRank":"","x":"127.0510352","y":"37.521527","deviceType":"pcmap","bounds":"127.0484925;37.5137746;127.062161;37.5291084"},"isNmap":false,"isBounds":true},"query":"query getPlacesList($input: PlacesInput, $isNmap: Boolean!, $isBounds: Boolean!) {\n  businesses: places(input: $input) {\n    total\n    items {\n      id\n      name\n      normalizedName\n      category\n      detailCid {\n        c0\n        c1\n        c2\n        c3\n        __typename\n      }\n      categoryCodeList\n      dbType\n      distance\n      roadAddress\n      address\n      commonAddress\n      bookingUrl\n      phone\n      virtualPhone\n      businessHours\n      daysOff\n      imageUrl\n      imageCount\n      x\n      y\n      poiInfo {\n        polyline {\n          shapeKey {\n            id\n            name\n            version\n            __typename\n          }\n          boundary {\n            minX\n            minY\n            maxX\n            maxY\n            __typename\n          }\n          details {\n            totalDistance\n            arrivalAddress\n            departureAddress\n            __typename\n          }\n          __typename\n        }\n        polygon {\n          shapeKey {\n            id\n            name\n            version\n            __typename\n          }\n          boundary {\n            minX\n            minY\n            maxX\n            maxY\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      subwayId\n      markerLabel @include(if: $isNmap) {\n        text\n        style\n        stylePreset\n        __typename\n      }\n      imageMarker @include(if: $isNmap) {\n        marker\n        markerSelected\n        __typename\n      }\n      oilPrice @include(if: $isNmap) {\n        gasoline\n        diesel\n        lpg\n        __typename\n      }\n      isPublicGas\n      isDelivery\n      isTableOrder\n      isPreOrder\n      isTakeOut\n      isCvsDelivery\n      hasBooking\n      naverBookingCategory\n      bookingDisplayName\n      bookingBusinessId\n      bookingVisitId\n      bookingPickupId\n      easyOrder {\n        easyOrderId\n        easyOrderCid\n        businessHours {\n          weekday {\n            start\n            end\n            __typename\n          }\n          weekend {\n            start\n            end\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      baemin {\n        businessHours {\n          deliveryTime {\n            start\n            end\n            __typename\n          }\n          closeDate {\n            start\n            end\n            __typename\n          }\n          temporaryCloseDate {\n            start\n            end\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      yogiyo {\n        businessHours {\n          actualDeliveryTime {\n            start\n            end\n            __typename\n          }\n          bizHours {\n            start\n            end\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      isPollingStation\n      hasNPay\n      talktalkUrl\n      visitorReviewCount\n      visitorReviewScore\n      blogCafeReviewCount\n      bookingReviewCount\n      streetPanorama {\n        id\n        pan\n        tilt\n        lat\n        lon\n        __typename\n      }\n      naverBookingHubId\n      bookingHubUrl\n      bookingHubButtonName\n      newOpening\n      __typename\n    }\n    optionsForMap @include(if: $isBounds) {\n      maxZoom\n      minZoom\n      includeMyLocation\n      maxIncludePoiCount\n      center\n      displayCorrectAnswer\n      correctAnswerPlaceId\n      spotId\n      __typename\n    }\n    queryString\n    siteSort\n    __typename\n  }\n}\n"},{"operationName":"getAdBusinessList","variables":{"input":{"query":"학동로50길","start":2,"localQueryString":"pr=place_pcmap&version=1.1.3&section=site&section=query&in_enc=utf-8&site_start=1&site_display=50&force_use_center_coord=1&query_rank=2&query=%ED%95%99%EB%8F%99%EB%A1%9C50%EA%B8%B8&site_sort=0&center_coord=127.0510352%3B37.521527&boost_partner=1&cid_correct=1&on_apt_dong=1&ic=nx","deviceType":"pcmap","siteSort":"0","businessType":"place","x":"127.0510352","y":"37.521527","rcode":"09680630"},"isNmap":false},"query":"query getAdBusinessList($input: AdBusinessesInput, $isNmap: Boolean!) {\n  adBusinesses(input: $input) {\n    total\n    isExpandedType\n    ... on RestaurantAdsResult {\n      items {\n        ...RestaurantAdItemFields\n        __typename\n      }\n      __typename\n    }\n    ... on HospitalAdsResult {\n      items {\n        ...HospitalAdItemFields\n        __typename\n      }\n      __typename\n    }\n    ... on PlaceAdsResult {\n      items {\n        ...PlaceAdItemFields\n        __typename\n      }\n      __typename\n    }\n    ... on AttractionAdsResult {\n      items {\n        ...AttractionAdItemFields\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n}\n\nfragment RestaurantAdItemFields on RestaurantAdSummary {\n  adId\n  adClickLog {\n    clickUrl\n    smartOrderClickUrl\n    trackingParameters {\n      n_ad_group_type\n      n_query\n      __typename\n    }\n    __typename\n  }\n  impressionEventUrl\n  adDescription\n  id\n  dbType\n  name\n  businessCategory\n  category\n  description\n  hasBooking\n  hasNPay\n  x\n  y\n  distance\n  imageUrl\n  imageCount\n  phone\n  virtualPhone\n  routeUrl\n  streetPanorama {\n    id\n    pan\n    tilt\n    lat\n    lon\n    __typename\n  }\n  roadAddress\n  address\n  commonAddress\n  blogCafeReviewCount\n  bookingReviewCount\n  totalReviewCount\n  bookingUrl\n  bookingBusinessId\n  talktalkUrl\n  detailCid {\n    c0\n    c1\n    c2\n    c3\n    __typename\n  }\n  options\n  promotionTitle\n  agencyId\n  businessHours\n  markerLabel @include(if: $isNmap) {\n    text\n    style\n    __typename\n  }\n  imageMarker @include(if: $isNmap) {\n    marker\n    markerSelected\n    __typename\n  }\n  imageUrls\n  bookingReviewScore\n  bookingHubUrl\n  bookingHubButtonName\n  microReview\n  tags\n  priceCategory\n  broadcastInfo {\n    program\n    date\n    menu\n    __typename\n  }\n  michelinGuide {\n    year\n    star\n    comment\n    url\n    hasGrade\n    isBib\n    alternateText\n    __typename\n  }\n  broadcasts {\n    program\n    menu\n    episode\n    broadcast_date\n    __typename\n  }\n  tvcastId\n  naverBookingCategory\n  saveCount\n  uniqueBroadcasts\n  isDelivery\n  isCvsDelivery\n  isTableOrder\n  isPreOrder\n  isTakeOut\n  bookingDisplayName\n  bookingVisitId\n  bookingPickupId\n  popularMenuImages {\n    name\n    price\n    bookingCount\n    menuUrl\n    menuListUrl\n    imageUrl\n    isPopular\n    usePanoramaImage\n    __typename\n  }\n  visitorReviewCount\n  visitorReviewScore\n  newOpening\n  __typename\n}\n\nfragment HospitalAdItemFields on HospitalAdSummary {\n  adId\n  adClickLog {\n    clickUrl\n    smartOrderClickUrl\n    trackingParameters {\n      n_ad_group_type\n      n_query\n      __typename\n    }\n    __typename\n  }\n  impressionEventUrl\n  adDescription\n  id\n  dbType\n  name\n  businessCategory\n  category\n  description\n  hasBooking\n  hasNPay\n  x\n  y\n  distance\n  imageUrl\n  imageCount\n  phone\n  virtualPhone\n  routeUrl\n  streetPanorama {\n    id\n    pan\n    tilt\n    lat\n    lon\n    __typename\n  }\n  roadAddress\n  address\n  commonAddress\n  blogCafeReviewCount\n  bookingReviewCount\n  totalReviewCount\n  bookingUrl\n  bookingBusinessId\n  talktalkUrl\n  detailCid {\n    c0\n    c1\n    c2\n    c3\n    __typename\n  }\n  options\n  promotionTitle\n  agencyId\n  businessHours\n  markerLabel @include(if: $isNmap) {\n    text\n    style\n    __typename\n  }\n  imageMarker @include(if: $isNmap) {\n    marker\n    markerSelected\n    __typename\n  }\n  medicalNo\n  visitorReviewCount\n  visitorReviewScore\n  talktalkUrl\n  __typename\n}\n\nfragment PlaceAdItemFields on PlaceAdSummary {\n  adId\n  adClickLog {\n    clickUrl\n    smartOrderClickUrl\n    trackingParameters {\n      n_ad_group_type\n      n_query\n      __typename\n    }\n    __typename\n  }\n  impressionEventUrl\n  adDescription\n  id\n  dbType\n  name\n  businessCategory\n  category\n  description\n  hasBooking\n  hasNPay\n  x\n  y\n  distance\n  imageUrl\n  imageCount\n  phone\n  virtualPhone\n  routeUrl\n  streetPanorama {\n    id\n    pan\n    tilt\n    lat\n    lon\n    __typename\n  }\n  roadAddress\n  address\n  commonAddress\n  blogCafeReviewCount\n  bookingReviewCount\n  totalReviewCount\n  bookingUrl\n  bookingBusinessId\n  talktalkUrl\n  detailCid {\n    c0\n    c1\n    c2\n    c3\n    __typename\n  }\n  options\n  promotionTitle\n  agencyId\n  businessHours\n  markerLabel @include(if: $isNmap) {\n    text\n    style\n    __typename\n  }\n  imageMarker @include(if: $isNmap) {\n    marker\n    markerSelected\n    __typename\n  }\n  medicalNo\n  normalizedName\n  categoryCodeList\n  daysOff\n  poiInfo {\n    polyline {\n      shapeKey {\n        id\n        name\n        version\n        __typename\n      }\n      boundary {\n        minX\n        minY\n        maxX\n        maxY\n        __typename\n      }\n      details {\n        totalDistance\n        arrivalAddress\n        departureAddress\n        __typename\n      }\n      __typename\n    }\n    polygon {\n      shapeKey {\n        id\n        name\n        version\n        __typename\n      }\n      boundary {\n        minX\n        minY\n        maxX\n        maxY\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n  subwayId\n  oilPrice @include(if: $isNmap) {\n    gasoline\n    diesel\n    lpg\n    __typename\n  }\n  isPublicGas\n  isDelivery\n  isTableOrder\n  isPreOrder\n  isTakeOut\n  isCvsDelivery\n  naverBookingCategory\n  bookingDisplayName\n  bookingVisitId\n  bookingPickupId\n  easyOrder {\n    easyOrderId\n    easyOrderCid\n    businessHours {\n      weekday {\n        start\n        end\n        __typename\n      }\n      weekend {\n        start\n        end\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n  baemin {\n    businessHours {\n      deliveryTime {\n        start\n        end\n        __typename\n      }\n      closeDate {\n        start\n        end\n        __typename\n      }\n      temporaryCloseDate {\n        start\n        end\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n  yogiyo {\n    businessHours {\n      actualDeliveryTime {\n        start\n        end\n        __typename\n      }\n      bizHours {\n        start\n        end\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n  isPollingStation\n  visitorReviewCount\n  visitorReviewScore\n  naverBookingHubId\n  bookingHubUrl\n  bookingHubButtonName\n  newOpening\n  __typename\n}\n\nfragment AttractionAdItemFields on AttractionAdSummary {\n  adId\n  adClickLog {\n    clickUrl\n    smartOrderClickUrl\n    trackingParameters {\n      n_ad_group_type\n      n_query\n      __typename\n    }\n    __typename\n  }\n  impressionEventUrl\n  adDescription\n  id\n  dbType\n  name\n  businessCategory\n  category\n  description\n  hasBooking\n  hasNPay\n  x\n  y\n  distance\n  imageUrl\n  imageCount\n  phone\n  virtualPhone\n  routeUrl\n  streetPanorama {\n    id\n    pan\n    tilt\n    lat\n    lon\n    __typename\n  }\n  roadAddress\n  address\n  commonAddress\n  blogCafeReviewCount\n  bookingReviewCount\n  totalReviewCount\n  bookingUrl\n  bookingBusinessId\n  talktalkUrl\n  detailCid {\n    c0\n    c1\n    c2\n    c3\n    __typename\n  }\n  options\n  promotionTitle\n  agencyId\n  businessHours\n  markerLabel @include(if: $isNmap) {\n    text\n    style\n    __typename\n  }\n  imageMarker @include(if: $isNmap) {\n    marker\n    markerSelected\n    __typename\n  }\n  cid\n  tags\n  visitorReviewCount\n  poiInfo {\n    polyline {\n      shapeKey {\n        id\n        __typename\n      }\n      __typename\n    }\n    polygon {\n      shapeKey {\n        id\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n  isDelivery\n  isTakeOut\n  isPreOrder\n  isTableOrder\n  newOpening\n  __typename\n}\n"}]';

    $ret = Curl($url, $json);
    $arr = json_decode($ret, true);
    $arr = $arr[0];
    
    
    $totalNum =  $arr["data"]["places"]["total"];
    $totalItem =  count($arr["data"]["places"]["items"]);

    /*
    $totalNum =  $arr["data"]["businesses"]["total"];
    $totalItem =  count($arr["data"]["businesses"]["items"]);
    */

    $check = 1;

    echo "Total: ".$totalNum."개 장소 <br>";

    /*    
    echo $ret;
    echo $arr;
    echo "arr: ".$arr;
    echo "insert 되어야 하는 item 개수: ".$totalItem."<br>";
    */
    
    $cnt = 0;
    $temp = "";

    
    insertIntoDB($arr);

    
    if($totalNum <= 50) {
        echo "done";
    }
    else {
        $addDiv = $totalNum / 50;
        for($i = 0; $i < $addDiv; $i++) {

            $startNum = $startNum + 50;
            // -> places */
            $json = '[{"operationName":"getPlacesList","variables":{"input":{"query":'.'"'.$addr.'"'.',"start":'.$startNum.',"display":50,"adult":true,"spq":false,"queryRank":"","x":"127.1197805","y":"37.503053","deviceType":"pcmap","bounds":"127.1105537;37.4952987;127.1375904;37.5106363"},"isNmap":false,"isBounds":true},"query":"query getPlacesList($input: PlacesInput, $isNmap: Boolean!, $isBounds: Boolean!) {\n  places: places(input: $input) {\n    total\n    items {\n      id\n      name\n      normalizedName\n      category\n      detailCid {\n        c0\n        c1\n        c2\n        c3\n        __typename\n      }\n      categoryCodeList\n      dbType\n      distance\n      roadAddress\n      address\n      commonAddress\n      bookingUrl\n      phone\n      virtualPhone\n      businessHours\n      daysOff\n      imageUrl\n      imageCount\n      x\n      y\n      poiInfo {\n        polyline {\n          shapeKey {\n            id\n            name\n            version\n            __typename\n          }\n          boundary {\n            minX\n            minY\n            maxX\n            maxY\n            __typename\n          }\n          details {\n            totalDistance\n            arrivalAddress\n            departureAddress\n            __typename\n          }\n          __typename\n        }\n        polygon {\n          shapeKey {\n            id\n            name\n            version\n            __typename\n          }\n          boundary {\n            minX\n            minY\n            maxX\n            maxY\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      subwayId\n      markerLabel @include(if: $isNmap) {\n        text\n        style\n        stylePreset\n        __typename\n      }\n      imageMarker @include(if: $isNmap) {\n        marker\n        markerSelected\n        __typename\n      }\n      oilPrice @include(if: $isNmap) {\n        gasoline\n        diesel\n        lpg\n        __typename\n      }\n      isPublicGas\n      isDelivery\n      isTableOrder\n      isPreOrder\n      isTakeOut\n      isCvsDelivery\n      hasBooking\n      naverBookingCategory\n      bookingDisplayName\n      bookingBusinessId\n      bookingVisitId\n      bookingPickupId\n      easyOrder {\n        easyOrderId\n        easyOrderCid\n        businessHours {\n          weekday {\n            start\n            end\n            __typename\n          }\n          weekend {\n            start\n            end\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      baemin {\n        businessHours {\n          deliveryTime {\n            start\n            end\n            __typename\n          }\n          closeDate {\n            start\n            end\n            __typename\n          }\n          temporaryCloseDate {\n            start\n            end\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      yogiyo {\n        businessHours {\n          actualDeliveryTime {\n            start\n            end\n            __typename\n          }\n          bizHours {\n            start\n            end\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      isPollingStation\n      hasNPay\n      talktalkUrl\n      visitorReviewCount\n      visitorReviewScore\n      blogCafeReviewCount\n      bookingReviewCount\n      streetPanorama {\n        id\n        pan\n        tilt\n        lat\n        lon\n        __typename\n      }\n      naverBookingHubId\n      bookingHubUrl\n      bookingHubButtonName\n      __typename\n    }\n    optionsForMap @include(if: $isBounds) {\n      maxZoom\n      minZoom\n      includeMyLocation\n      maxIncludePoiCount\n      center\n      displayCorrectAnswer\n      correctAnswerPlaceId\n      spotId\n      __typename\n    }\n    __typename\n  }\n}\n"}]';
            //$json = '[{"operationName":"getPlacesList","variables":{"input":{"query":'.'"'.$addr.'"'.',"start":'.$startNum.',"display":50,"adult":false,"spq":false,"queryRank":"","x":"127.0510352","y":"37.521527","deviceType":"pcmap","bounds":"127.0484925;37.5137746;127.062161;37.5291084"},"isNmap":false,"isBounds":true},"query":"query getPlacesList($input: PlacesInput, $isNmap: Boolean!, $isBounds: Boolean!) {\n  businesses: places(input: $input) {\n    total\n    items {\n      id\n      name\n      normalizedName\n      category\n      detailCid {\n        c0\n        c1\n        c2\n        c3\n        __typename\n      }\n      categoryCodeList\n      dbType\n      distance\n      roadAddress\n      address\n      commonAddress\n      bookingUrl\n      phone\n      virtualPhone\n      businessHours\n      daysOff\n      imageUrl\n      imageCount\n      x\n      y\n      poiInfo {\n        polyline {\n          shapeKey {\n            id\n            name\n            version\n            __typename\n          }\n          boundary {\n            minX\n            minY\n            maxX\n            maxY\n            __typename\n          }\n          details {\n            totalDistance\n            arrivalAddress\n            departureAddress\n            __typename\n          }\n          __typename\n        }\n        polygon {\n          shapeKey {\n            id\n            name\n            version\n            __typename\n          }\n          boundary {\n            minX\n            minY\n            maxX\n            maxY\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      subwayId\n      markerLabel @include(if: $isNmap) {\n        text\n        style\n        stylePreset\n        __typename\n      }\n      imageMarker @include(if: $isNmap) {\n        marker\n        markerSelected\n        __typename\n      }\n      oilPrice @include(if: $isNmap) {\n        gasoline\n        diesel\n        lpg\n        __typename\n      }\n      isPublicGas\n      isDelivery\n      isTableOrder\n      isPreOrder\n      isTakeOut\n      isCvsDelivery\n      hasBooking\n      naverBookingCategory\n      bookingDisplayName\n      bookingBusinessId\n      bookingVisitId\n      bookingPickupId\n      easyOrder {\n        easyOrderId\n        easyOrderCid\n        businessHours {\n          weekday {\n            start\n            end\n            __typename\n          }\n          weekend {\n            start\n            end\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      baemin {\n        businessHours {\n          deliveryTime {\n            start\n            end\n            __typename\n          }\n          closeDate {\n            start\n            end\n            __typename\n          }\n          temporaryCloseDate {\n            start\n            end\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      yogiyo {\n        businessHours {\n          actualDeliveryTime {\n            start\n            end\n            __typename\n          }\n          bizHours {\n            start\n            end\n            __typename\n          }\n          __typename\n        }\n        __typename\n      }\n      isPollingStation\n      hasNPay\n      talktalkUrl\n      visitorReviewCount\n      visitorReviewScore\n      blogCafeReviewCount\n      bookingReviewCount\n      streetPanorama {\n        id\n        pan\n        tilt\n        lat\n        lon\n        __typename\n      }\n      naverBookingHubId\n      bookingHubUrl\n      bookingHubButtonName\n      newOpening\n      __typename\n    }\n    optionsForMap @include(if: $isBounds) {\n      maxZoom\n      minZoom\n      includeMyLocation\n      maxIncludePoiCount\n      center\n      displayCorrectAnswer\n      correctAnswerPlaceId\n      spotId\n      __typename\n    }\n    queryString\n    siteSort\n    __typename\n  }\n}\n"},{"operationName":"getAdBusinessList","variables":{"input":{"query":"학동로50길","start":2,"localQueryString":"pr=place_pcmap&version=1.1.3&section=site&section=query&in_enc=utf-8&site_start=1&site_display=50&force_use_center_coord=1&query_rank=2&query=%ED%95%99%EB%8F%99%EB%A1%9C50%EA%B8%B8&site_sort=0&center_coord=127.0510352%3B37.521527&boost_partner=1&cid_correct=1&on_apt_dong=1&ic=nx","deviceType":"pcmap","siteSort":"0","businessType":"place","x":"127.0510352","y":"37.521527","rcode":"09680630"},"isNmap":false},"query":"query getAdBusinessList($input: AdBusinessesInput, $isNmap: Boolean!) {\n  adBusinesses(input: $input) {\n    total\n    isExpandedType\n    ... on RestaurantAdsResult {\n      items {\n        ...RestaurantAdItemFields\n        __typename\n      }\n      __typename\n    }\n    ... on HospitalAdsResult {\n      items {\n        ...HospitalAdItemFields\n        __typename\n      }\n      __typename\n    }\n    ... on PlaceAdsResult {\n      items {\n        ...PlaceAdItemFields\n        __typename\n      }\n      __typename\n    }\n    ... on AttractionAdsResult {\n      items {\n        ...AttractionAdItemFields\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n}\n\nfragment RestaurantAdItemFields on RestaurantAdSummary {\n  adId\n  adClickLog {\n    clickUrl\n    smartOrderClickUrl\n    trackingParameters {\n      n_ad_group_type\n      n_query\n      __typename\n    }\n    __typename\n  }\n  impressionEventUrl\n  adDescription\n  id\n  dbType\n  name\n  businessCategory\n  category\n  description\n  hasBooking\n  hasNPay\n  x\n  y\n  distance\n  imageUrl\n  imageCount\n  phone\n  virtualPhone\n  routeUrl\n  streetPanorama {\n    id\n    pan\n    tilt\n    lat\n    lon\n    __typename\n  }\n  roadAddress\n  address\n  commonAddress\n  blogCafeReviewCount\n  bookingReviewCount\n  totalReviewCount\n  bookingUrl\n  bookingBusinessId\n  talktalkUrl\n  detailCid {\n    c0\n    c1\n    c2\n    c3\n    __typename\n  }\n  options\n  promotionTitle\n  agencyId\n  businessHours\n  markerLabel @include(if: $isNmap) {\n    text\n    style\n    __typename\n  }\n  imageMarker @include(if: $isNmap) {\n    marker\n    markerSelected\n    __typename\n  }\n  imageUrls\n  bookingReviewScore\n  bookingHubUrl\n  bookingHubButtonName\n  microReview\n  tags\n  priceCategory\n  broadcastInfo {\n    program\n    date\n    menu\n    __typename\n  }\n  michelinGuide {\n    year\n    star\n    comment\n    url\n    hasGrade\n    isBib\n    alternateText\n    __typename\n  }\n  broadcasts {\n    program\n    menu\n    episode\n    broadcast_date\n    __typename\n  }\n  tvcastId\n  naverBookingCategory\n  saveCount\n  uniqueBroadcasts\n  isDelivery\n  isCvsDelivery\n  isTableOrder\n  isPreOrder\n  isTakeOut\n  bookingDisplayName\n  bookingVisitId\n  bookingPickupId\n  popularMenuImages {\n    name\n    price\n    bookingCount\n    menuUrl\n    menuListUrl\n    imageUrl\n    isPopular\n    usePanoramaImage\n    __typename\n  }\n  visitorReviewCount\n  visitorReviewScore\n  newOpening\n  __typename\n}\n\nfragment HospitalAdItemFields on HospitalAdSummary {\n  adId\n  adClickLog {\n    clickUrl\n    smartOrderClickUrl\n    trackingParameters {\n      n_ad_group_type\n      n_query\n      __typename\n    }\n    __typename\n  }\n  impressionEventUrl\n  adDescription\n  id\n  dbType\n  name\n  businessCategory\n  category\n  description\n  hasBooking\n  hasNPay\n  x\n  y\n  distance\n  imageUrl\n  imageCount\n  phone\n  virtualPhone\n  routeUrl\n  streetPanorama {\n    id\n    pan\n    tilt\n    lat\n    lon\n    __typename\n  }\n  roadAddress\n  address\n  commonAddress\n  blogCafeReviewCount\n  bookingReviewCount\n  totalReviewCount\n  bookingUrl\n  bookingBusinessId\n  talktalkUrl\n  detailCid {\n    c0\n    c1\n    c2\n    c3\n    __typename\n  }\n  options\n  promotionTitle\n  agencyId\n  businessHours\n  markerLabel @include(if: $isNmap) {\n    text\n    style\n    __typename\n  }\n  imageMarker @include(if: $isNmap) {\n    marker\n    markerSelected\n    __typename\n  }\n  medicalNo\n  visitorReviewCount\n  visitorReviewScore\n  talktalkUrl\n  __typename\n}\n\nfragment PlaceAdItemFields on PlaceAdSummary {\n  adId\n  adClickLog {\n    clickUrl\n    smartOrderClickUrl\n    trackingParameters {\n      n_ad_group_type\n      n_query\n      __typename\n    }\n    __typename\n  }\n  impressionEventUrl\n  adDescription\n  id\n  dbType\n  name\n  businessCategory\n  category\n  description\n  hasBooking\n  hasNPay\n  x\n  y\n  distance\n  imageUrl\n  imageCount\n  phone\n  virtualPhone\n  routeUrl\n  streetPanorama {\n    id\n    pan\n    tilt\n    lat\n    lon\n    __typename\n  }\n  roadAddress\n  address\n  commonAddress\n  blogCafeReviewCount\n  bookingReviewCount\n  totalReviewCount\n  bookingUrl\n  bookingBusinessId\n  talktalkUrl\n  detailCid {\n    c0\n    c1\n    c2\n    c3\n    __typename\n  }\n  options\n  promotionTitle\n  agencyId\n  businessHours\n  markerLabel @include(if: $isNmap) {\n    text\n    style\n    __typename\n  }\n  imageMarker @include(if: $isNmap) {\n    marker\n    markerSelected\n    __typename\n  }\n  medicalNo\n  normalizedName\n  categoryCodeList\n  daysOff\n  poiInfo {\n    polyline {\n      shapeKey {\n        id\n        name\n        version\n        __typename\n      }\n      boundary {\n        minX\n        minY\n        maxX\n        maxY\n        __typename\n      }\n      details {\n        totalDistance\n        arrivalAddress\n        departureAddress\n        __typename\n      }\n      __typename\n    }\n    polygon {\n      shapeKey {\n        id\n        name\n        version\n        __typename\n      }\n      boundary {\n        minX\n        minY\n        maxX\n        maxY\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n  subwayId\n  oilPrice @include(if: $isNmap) {\n    gasoline\n    diesel\n    lpg\n    __typename\n  }\n  isPublicGas\n  isDelivery\n  isTableOrder\n  isPreOrder\n  isTakeOut\n  isCvsDelivery\n  naverBookingCategory\n  bookingDisplayName\n  bookingVisitId\n  bookingPickupId\n  easyOrder {\n    easyOrderId\n    easyOrderCid\n    businessHours {\n      weekday {\n        start\n        end\n        __typename\n      }\n      weekend {\n        start\n        end\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n  baemin {\n    businessHours {\n      deliveryTime {\n        start\n        end\n        __typename\n      }\n      closeDate {\n        start\n        end\n        __typename\n      }\n      temporaryCloseDate {\n        start\n        end\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n  yogiyo {\n    businessHours {\n      actualDeliveryTime {\n        start\n        end\n        __typename\n      }\n      bizHours {\n        start\n        end\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n  isPollingStation\n  visitorReviewCount\n  visitorReviewScore\n  naverBookingHubId\n  bookingHubUrl\n  bookingHubButtonName\n  newOpening\n  __typename\n}\n\nfragment AttractionAdItemFields on AttractionAdSummary {\n  adId\n  adClickLog {\n    clickUrl\n    smartOrderClickUrl\n    trackingParameters {\n      n_ad_group_type\n      n_query\n      __typename\n    }\n    __typename\n  }\n  impressionEventUrl\n  adDescription\n  id\n  dbType\n  name\n  businessCategory\n  category\n  description\n  hasBooking\n  hasNPay\n  x\n  y\n  distance\n  imageUrl\n  imageCount\n  phone\n  virtualPhone\n  routeUrl\n  streetPanorama {\n    id\n    pan\n    tilt\n    lat\n    lon\n    __typename\n  }\n  roadAddress\n  address\n  commonAddress\n  blogCafeReviewCount\n  bookingReviewCount\n  totalReviewCount\n  bookingUrl\n  bookingBusinessId\n  talktalkUrl\n  detailCid {\n    c0\n    c1\n    c2\n    c3\n    __typename\n  }\n  options\n  promotionTitle\n  agencyId\n  businessHours\n  markerLabel @include(if: $isNmap) {\n    text\n    style\n    __typename\n  }\n  imageMarker @include(if: $isNmap) {\n    marker\n    markerSelected\n    __typename\n  }\n  cid\n  tags\n  visitorReviewCount\n  poiInfo {\n    polyline {\n      shapeKey {\n        id\n        __typename\n      }\n      __typename\n    }\n    polygon {\n      shapeKey {\n        id\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n  isDelivery\n  isTakeOut\n  isPreOrder\n  isTableOrder\n  newOpening\n  __typename\n}\n"}]';
            
            $ret = Curl($url, $json);
            $arr = json_decode($ret, true);
            $arr = $arr[0];
            insertIntoDB($arr);
        }
    }
    
    global $cnt;
    echo $cnt."<br>";
    echo "Done <br><br>";
            
}

function insertIntoDB($arr) {

    $j = 0;


    global $temp;

    while($j < count($arr["data"]["places"]["items"])) {
    //while($j < count($arr["data"]["businesses"]["items"])) {
      
        $data = $arr["data"]["places"]["items"][$j];
        //$data = $arr["data"]["businesses"]["items"][$j];

        $name = $data["name"];
        $nid = $data["id"];
        $roadAddress = $data["roadAddress"];
        $jibunAddress = $data["commonAddress"];
        $detailAddr = $data["address"];
        $category = $data["category"];
        $lat = $data["x"];
        $lon = $data["y"];
        $visitReviewCount = $data["visitorReviewCount"];
        $visitReviewScore = $data["visitorReviewScore"];
        $blogCafeReviewCount = $data["blogCafeReviewCount"];
        $businessHour = $data["businessHours"];
        $phone = $data["phone"];
        $imageUrl = $data["imageUrl"];
        $imageCount = $data["imageCount"];

        if($temp == $nid) {
            $j++;
            continue;
        }
        else {
            $temp = $nid;
            
            if(empty($imageCount)) $imageCount = 0;
            if(empty($visitReviewCount)) $visitReviewCount = 0;
            if(empty($visitReviewScore)) $visitReviewScore = 0;
            if(empty($blogCafeReviewCount)) $blogCafeReviewCount = 0;
            
            $visitReviewCount = str_replace(",", "", $visitReviewCount);
            $blogCafeReviewCount = str_replace(",", "", $blogCafeReviewCount);
            $imageCount = str_replace(",", "", $imageCount);

            if(mb_strlen($businessHour) > 300) {
                $businessHour = mb_substr($businessHour, 0, 300);
            }
    
            $connNav = mysqli_connect("your ip address", "id", "password", "places");

            $sql  = "INSERT INTO navplaces (
                name, nid, roadAddr, jibunAddr, detailAddr,
                category, lat, lon, visitReviewCount, visitReviewScore, blogCafeReviewCount,
                businessHour, phone, imageUrl, imageCount
            ) VALUES (
                '$name', '$nid', '$roadAddress', '$jibunAddress', '$detailAddr',
                '$category', '$lat', '$lon', '$visitReviewCount', '$visitReviewScore', '$blogCafeReviewCount',
                '$businessHour', '$phone', '$imageUrl', '$imageCount'
            )";
    
            $result = mysqli_query($connNav, $sql);
    
            if($result === false) {
                //echo mysqli_error($connNav);
                //echo "<br>";
    
                $name = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $name);
    
                $sql2  = "INSERT INTO navplaces (
                    name, nid, roadAddr, jibunAddr, detailAddr,
                    category, lat, lon, visitReviewCount, visitReviewScore, blogCafeReviewCount,
                    businessHour, phone, imageUrl, imageCount
                ) VALUES (
                    '$name', '$nid', '$roadAddress', '$jibunAddress', '$detailAddr',
                    '$category', '$lat', '$lon', '$visitReviewCount', '$visitReviewScore', '$blogCafeReviewCount',
                    '', '$phone', '$imageUrl', '$imageCount'
                )";
        
                $result2 = mysqli_query($connNav, $sql2);
    
                if($result2 === false) {
                    echo mysqli_error($connNav);
                    echo "second bug <br>";

                    $name = preg_replace("/[0-9]/","", $name);
    
                    $sql3  = "INSERT INTO navplaces (
                        name, nid, roadAddr, jibunAddr, detailAddr,
                        category, lat, lon, visitReviewCount, visitReviewScore, blogCafeReviewCount,
                        businessHour, phone, imageUrl, imageCount
                    ) VALUES (
                        '$name', '$nid', '$roadAddress', '$jibunAddress', '$detailAddr',
                        '$category', '$lat', '$lon', '$visitReviewCount', '$visitReviewScore', '$blogCafeReviewCount',
                        '', '$phone', '$imageUrl', '$imageCount'
                    )";

                    $result3 = mysqli_query($connNav, $sql3);

                }
                else {
                    //echo "bug fixed <br>";
                }
    
            }
            else {
                //echo "success";
            }
    
            $j++;
            global $cnt;
            $cnt++;
            //echo $cnt."<br>";
        }
    }
}

//AutoC("충무로");


?>
