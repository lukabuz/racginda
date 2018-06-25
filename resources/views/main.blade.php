<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="CSS/style.css">
  <title>რაცგინდა</title>
</head>
<body>
  <main class="grid">
    <div class="form">
    <form action='/' method='POST' id="form1">
      <h1>ასჯერ გაზომე, ერთხელ გაჭერი.</h1>
      <textarea name="text" rows="6" cols="80"></textarea>
      <button class="btn" type="submit" form="form1">გაჭრა</button>
    </div>
    <div class="item">
      <div class="content">
        <p>ძირითადად, ნოვში მყოფი ადამიანი, დამარცხებული გუნდის ყველაზე სუსტ მოთამაშეს ანაცვლებს.</p>
      </div>
      <div class="voting">
        <svg class="upvote" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M288.662 352H31.338c-17.818 0-26.741-21.543-14.142-34.142l128.662-128.662c7.81-7.81 20.474-7.81 28.284 0l128.662 128.662c12.6 12.599 3.676 34.142-14.142 34.142z"/></svg>
        <span>1</span>
        <svg class="downvote" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"/></svg>
      </div>
    </div>
  </main>
</body>
</html>
