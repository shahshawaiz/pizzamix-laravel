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
                <b>Add</b>
                
                {{ Form::open( ['route' => 'ingredient.store'] ) }}

                   {{ Form::label('ingredientCode', 'Ingredient Code') }}
                   {{ Form::text('ingredientCode') }}

                   <br/>

                   {{ Form::label('name', 'Ingredient Name') }}
                   {{ Form::text('name') }}

                   <br/>

                   {{ Form::label('description', 'Description') }}
                   {{ Form::text('description') }}

                   <br/>

                   {{ Form::label('price', 'Price') }}
                   {{ Form::number('price') }}

                   <br/>
                   
                   {{ Form::submit('Save') }}

                {{ Form::close() }}

            </div>
        </div>
    </body>
</html>
