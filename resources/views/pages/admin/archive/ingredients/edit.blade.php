<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                
                <h2>Update</h2>

                {{ Form::model( 
                    $ingredient,                 
                      [
                        'method' => 'patch',
                        'route' => ['ingredient.update', $ingredient->id]
                      ]) 
                 }}

                   {{ Form::text('ingredientCode', $ingredient->ingredientCode , array('placeholder'=>'Ingredient Code') ) }}

                   <br/>

                   {{ Form::text('name' , $ingredient->name, array('placeholder'=>'Ingredient Name') ) }}

                   <br/>

                   {{ Form::text('description', $ingredient->description, array('placeholder'=>'Description')) }}

                   <br/>

                   {{ Form::number('price', $ingredient->price, array('placeholder'=>'Price')) }}

                   <br/>
                   
                   {{ Form::submit('Update') }}

                {{ Form::close() }}



            </div>
        </div>
    </body>
</html>
