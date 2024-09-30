<?php

session_start();
include_once "../db/config.php";

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$type_form = $_GET['typeForm'];

if ($type_form == 'get_all_news') {
  $result_news = $pdo->prepare("SELECT * FROM news ORDER BY id DESC ");
  $result_news->execute();
  $num_news = $result_news->rowCount();

  if ($num_news <= 0) {
    echo $return = "              
              <div class='col-12 col-md-12'>
                <article class='ueEveColumn position-relative shadow bg-white mb-6'>
                  <div class='ueDescriptionWrap pt-5 pb-8 px-5'>
                    <strong style='color: red' class='d-block mb-2'>Sem noticias</strong>
                    <h3 class='h3Small fwMedium mb-3'>
                      <a href='eventSingle.html'>Não foram encontradas noticias no momento</a>
                    </h3>
                    <address>
                      <ul class='list-unstyled ueScheduleList'>
                        <li>
                          <i class='icomoon-clock icn position-absolute'><span class='sr-only'>icon</span></i>
                          xx:xxh - xx:xxh
                        </li>
                        <li>
                          <i class='icomoon-location icn position-absolute'><span class='sr-only'>icon</span></i>
                          xxxxx xxx xxxxxxx xx xxx
                        </li>
                      </ul>
                    </address>
                  </div>
                </article>
              </div>";
  } else {
    $return = "";

    while ($row_news = $result_news->fetch(PDO::FETCH_ASSOC)) {

      extract($row_news);

      $decode_images_news = json_decode($images_news);

      $url_image = "";

      if ($decode_images_news) {
        $url_image = $decode_images_news[0];
      } else {
        $url_image = "https://img.freepik.com/free-vector/realistic-news-studio-background_23-2149985606.jpg";
      }

      $hrefNews = "http://localhost/web-consulado_ponta_negra-php/news/detailsNews/$id";

      $return .= "
        <div class='col-12 col-md-6'>
          <article class='npbColumn shadow bg-white mb-6 mb-xl-12'>
            <div class='imgHolder position-relative' style='height: 20rem; position: relative'>
              <a href='$hrefNews' style='height: 20rem; position: relative'>
                <img
                  src='$url_image'
                  style='top: 0; left: 0; height: 100%'
                  class='img-fluid w-100 d-block'
                  alt='image description'
                />
              </a>
              <time
                datetime='2011-01-12'
                class='npbTimeTag font-weight-bold fontAlter position-absolute text-white px-2 py-1'
                >$date_news</time
              >
            </div>
            <div class='npbDescriptionWrap px-5 pt-8 pb-5'>
              <strong
                class='d-block npbcmWrap font-weight-normal mb-1'
              >
                <span class='mr-5'>$category_news</span>
              </strong>
              <h3 class='fwSemiBold mb-5'>
                <a href='$hrefNews'
                  >$title_news</a
                >
              </h3>
              <a
                href='$hrefNews'
                class='btnCr d-inline-block align-top fontAlter'
                >Continuar lendo
                <i
                  class='icomoon-arrowRight bcIcn ml-2 align-middle'
                  ><span class='sr-only'>icon</span></i
                ></a
              >
            </div>
          </article>
        </div>
      ";
    }

    echo $return;
  }
}
