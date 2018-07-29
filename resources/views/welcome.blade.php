<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script type="text/javascript" src="{{asset('js/vue.js')}}"></script>

    </head>
    <body>
        <div class="container">
             <div class="content">
                 <div class="title">
                     <p>@{{ message }}</p>
                 </div>
             </div>
         </div>
    </body>
    <script type="text/javascript">
      new Vue({
         el: '.title',
         data: {
             message: 'Hello Laravel!'
         }
     })
 </script>
</html>
