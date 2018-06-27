<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="https://i.imgur.com/OdB5Wd5.png" type="image/png" sizes="16x16">
  <meta property="og:url"                content="http://racginda.site" />
  <meta property="og:type"               content="website" />
  <meta property="og:title"              content="რაცგინდა" />
  <meta property="og:description"        content="რაცგინდა - აქ სიტყვის თავისუფლება და ანონიმურობა მეფობს" />
  <meta property="og:image"              content="https://i.imgur.com/LG0A70T.png" />
  @include('inc.css')
  <title>რაცგინდა</title>
</head>
<body>
  @if(Session::has('message'))
  <div class="notification success">
    <p>{{Session::get('message')}}</p>
    <h1>x</h1>
  </div>
  @endif

  @if(Session::has('error'))
  <div class="notification fail">
    <p>{{Session::get('error')}}</p>
    <h1>x</h1>
  </div>
  @endif

  <main class="grid">
      <div class="refresh">
        @if(app('request')->input('sort') == 'new')
        <a href="../?sort=new">
        @else
        <a href="../">
        @endif
        <svg class="refresh-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z"/></svg></a>
      </div>
    <div class="sorting">
      <a href="../">
        <svg class="hot-sort" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M216 23.858c0-23.802-30.653-32.765-44.149-13.038C48 191.851 224 200 224 288c0 35.629-29.114 64.458-64.85 63.994C123.98 351.538 96 322.22 96 287.046v-85.51c0-21.703-26.471-32.225-41.432-16.504C27.801 213.158 0 261.332 0 320c0 105.869 86.131 192 192 192s192-86.131 192-192c0-170.29-168-193.003-168-296.142z"/></svg></a>
      <a href="../?sort=new">
        <svg class="new-sort" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm57.1 350.1L224.9 294c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h48c6.6 0 12 5.4 12 12v137.7l63.5 46.2c5.4 3.9 6.5 11.4 2.6 16.8l-28.2 38.8c-3.9 5.3-11.4 6.5-16.8 2.6z"/></svg></a>
    </div>
    <div class="form">
    <form action='../submission/{{$submission->id}}' method='POST' id="form1">
      <h1>უპასუხე.</h1>
      @csrf
      <textarea placeholder="ასჯერ გაზომე, ერთხელ გაჭერი." name="text" rows="6" cols="80"></textarea>
      <button class="btn" type="submit" form="form1">გაჭრა</button>
    </div>

    <div class="item">
      <div class="content">
        <p>{!! preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" target="_blank">$1</a>', nl2br(e($submission->description))) !!}</p>
      </div>
      <div class="voting" data-id="{{$submission->id}}">
        @if($submission->votevalue() == 1)
        <svg class="upvote active" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M288.662 352H31.338c-17.818 0-26.741-21.543-14.142-34.142l128.662-128.662c7.81-7.81 20.474-7.81 28.284 0l128.662 128.662c12.6 12.599 3.676 34.142-14.142 34.142z"/></svg>
        @else
        <svg class="upvote" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M288.662 352H31.338c-17.818 0-26.741-21.543-14.142-34.142l128.662-128.662c7.81-7.81 20.474-7.81 28.284 0l128.662 128.662c12.6 12.599 3.676 34.142-14.142 34.142z"/></svg>
        @endif
        <span>{{$submission->score()}}</span>
        @if($submission->votevalue() == -1)
        <svg class="downvote active" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"/></svg>
        @else
        <svg class="downvote" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"/></svg>
        @endif
      </div>
      <div class="author">
        <a href="../submission/{{$submission->id}}">
        <svg class="author-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M383.9 308.3l23.9-62.6c4-10.5-3.7-21.7-15-21.7h-58.5c11-18.9 17.8-40.6 17.8-64v-.3c39.2-7.8 64-19.1 64-31.7 0-13.3-27.3-25.1-70.1-33-9.2-32.8-27-65.8-40.6-82.8-9.5-11.9-25.9-15.6-39.5-8.8l-27.6 13.8c-9 4.5-19.6 4.5-28.6 0L182.1 3.4c-13.6-6.8-30-3.1-39.5 8.8-13.5 17-31.4 50-40.6 82.8-42.7 7.9-70 19.7-70 33 0 12.6 24.8 23.9 64 31.7v.3c0 23.4 6.8 45.1 17.8 64H56.3c-11.5 0-19.2 11.7-14.7 22.3l25.8 60.2C27.3 329.8 0 372.7 0 422.4v44.8C0 491.9 20.1 512 44.8 512h358.4c24.7 0 44.8-20.1 44.8-44.8v-44.8c0-48.4-25.8-90.4-64.1-114.1zM176 480l-41.6-192 49.6 32 24 40-32 120zm96 0l-32-120 24-40 49.6-32L272 480zm41.7-298.5c-3.9 11.9-7 24.6-16.5 33.4-10.1 9.3-48 22.4-64-25-2.8-8.4-15.4-8.4-18.3 0-17 50.2-56 32.4-64 25-9.5-8.8-12.7-21.5-16.5-33.4-.8-2.5-6.3-5.7-6.3-5.8v-10.8c28.3 3.6 61 5.8 96 5.8s67.7-2.1 96-5.8v10.8c-.1.1-5.6 3.2-6.4 5.8z"/></svg>
        </a>
        <a href="../submission/{{$submission->id}}"><h3>{{$submission->getid()}}</h3></a>
        <a href="../submission/{{$submission->id}}"><svg class="reply-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M8.309 189.836L184.313 37.851C199.719 24.546 224 35.347 224 56.015v80.053c160.629 1.839 288 34.032 288 186.258 0 61.441-39.581 122.309-83.333 154.132-13.653 9.931-33.111-2.533-28.077-18.631 45.344-145.012-21.507-183.51-176.59-185.742V360c0 20.7-24.3 31.453-39.687 18.164l-176.004-152c-11.071-9.562-11.086-26.753 0-36.328z"/></svg></a>
        <a href="#"><h3>{{$submission->replyconut()}}</h3></a>
      </div>
    </div>

    @forelse($replies as $reply)
      <div class="item-reply">
        <div class="content">
          <p>{!! preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" target="_blank">$1</a>', nl2br(e($reply->description))) !!}</p>
        </div>
        <div>
        </div>
        <div class="author">
          <svg class="author-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M383.9 308.3l23.9-62.6c4-10.5-3.7-21.7-15-21.7h-58.5c11-18.9 17.8-40.6 17.8-64v-.3c39.2-7.8 64-19.1 64-31.7 0-13.3-27.3-25.1-70.1-33-9.2-32.8-27-65.8-40.6-82.8-9.5-11.9-25.9-15.6-39.5-8.8l-27.6 13.8c-9 4.5-19.6 4.5-28.6 0L182.1 3.4c-13.6-6.8-30-3.1-39.5 8.8-13.5 17-31.4 50-40.6 82.8-42.7 7.9-70 19.7-70 33 0 12.6 24.8 23.9 64 31.7v.3c0 23.4 6.8 45.1 17.8 64H56.3c-11.5 0-19.2 11.7-14.7 22.3l25.8 60.2C27.3 329.8 0 372.7 0 422.4v44.8C0 491.9 20.1 512 44.8 512h358.4c24.7 0 44.8-20.1 44.8-44.8v-44.8c0-48.4-25.8-90.4-64.1-114.1zM176 480l-41.6-192 49.6 32 24 40-32 120zm96 0l-32-120 24-40 49.6-32L272 480zm41.7-298.5c-3.9 11.9-7 24.6-16.5 33.4-10.1 9.3-48 22.4-64-25-2.8-8.4-15.4-8.4-18.3 0-17 50.2-56 32.4-64 25-9.5-8.8-12.7-21.5-16.5-33.4-.8-2.5-6.3-5.7-6.3-5.8v-10.8c28.3 3.6 61 5.8 96 5.8s67.7-2.1 96-5.8v10.8c-.1.1-5.6 3.2-6.4 5.8z"/></svg>
          <h3>{{$reply->getid()}}</h3>
        </div>
      </div>
    @empty
    @endforelse

  </main>
</body>

<script
 src="https://code.jquery.com/jquery-3.3.1.min.js"
 integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
 crossorigin="anonymous"></script>
 
  <script>
    $(document).ready(function(){

      $('.upvote').click(function(){

        var id = $(this).parent().attr('data-id');
 
        if( $(this).hasClass('active') ){
          $(this).removeClass('active');

          let currentScore = $(this).closest('.voting').children('span').html();
          currentScore--;
          $(this).closest('.voting').children('span').html(currentScore);

          $.get("/api/vote/" + id + "/upvote", function(data, status){
              console.log("Data: " + data + "\nStatus: " + status);
          });

          return;
 
          //IF UPVOTE ACTIVE AND PRESSED AGAIN DOSMTH
        }
 
        if( $(this).closest('.voting').children('.downvote').hasClass('active') ){
          $(this).closest('.voting').children('.downvote').removeClass('active');
          $(this).addClass('active');

          let currentScore = $(this).closest('.voting').children('span').html();
          currentScore++;
          currentScore++;
          $(this).closest('.voting').children('span').html(currentScore);

          $.get("/api/vote/" + id + "/upvote", function(data, status){
              console.log("Data: " + data + "\nStatus: " + status);
          });

          return;
 
          //IF IT IS ALREADY DOWNVOTED BUT UPVOTE IS PRESSED DOSMTH
        }
 
        $(this).addClass('active');
        //NEUTRAL VOTE DOSMTH

        let currentScore = $(this).closest('.voting').children('span').html();
        currentScore++;
        $(this).closest('.voting').children('span').html(currentScore);
        
        $.get("/api/vote/" + id + "/upvote", function(data, status){
              console.log("Data: " + data + "\nStatus: " + status);
          });

      });
 
      $('.downvote').click(function(){

        var id = $(this).parent().attr('data-id');
 
        if( $(this).hasClass('active') ){
          $(this).removeClass('active');

          let currentScore = $(this).closest('.voting').children('span').html();
          currentScore++;
          $(this).closest('.voting').children('span').html(currentScore);

          $.get("/api/vote/" + id + "/downvote", function(data, status){
              console.log("Data: " + data + "\nStatus: " + status);
          });

          return;
 
          //IF UPVOTE ACTIVE AND PRESSED AGAIN DOSMTH
        }
 
        if( $(this).closest('.voting').children('.upvote').hasClass('active') ){
          $(this).closest('.voting').children('.upvote').removeClass('active');
          $(this).addClass('active');

          let currentScore = $(this).closest('.voting').children('span').html();
          currentScore--;
          currentScore--;
          $(this).closest('.voting').children('span').html(currentScore);

          $.get("/api/vote/" + id + "/downvote", function(data, status){
              console.log("Data: " + data + "\nStatus: " + status);
          });

          return;
 
          //IF IT IS ALREADY DOWNVOTED BUT UPVOTE IS PRESSED DOSMTH
        }
 
        $(this).addClass('active');
        //NEUTRAL VOTE DOSMTH

        let currentScore = $(this).closest('.voting').children('span').html();
        currentScore--;
        $(this).closest('.voting').children('span').html(currentScore);

        $.get("/api/vote/" + id + "/downvote", function(data, status){
              console.log("Data: " + data + "\nStatus: " + status);
          });
 
      });

      $('.notification h1').click(function(){
        $('.notification').css('height', '0');
        $('.notification h1').css('display', 'none');
      });

    });
  </script>

  <script>
        (function(b, o, i, l, e, r) {
            b.GoogleAnalyticsObject = l;
            b[l] || (b[l] = function() {
                (b[l].q = b[l].q || []).push(arguments)
            });
            b[l].l = +new Date;
            e = o.createElement(i);
            r = o.getElementsByTagName(i)[0];
            e.src = '//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e, r)
        }(window, document, 'script', 'ga'));
        ga('create', 'UA-121429645-1', 'auto');
        
    </script>

</html>
