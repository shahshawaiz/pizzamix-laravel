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
                <h2>products details</h2>

                  <table border="2">
                    <tr>
                        <td style="text-align:left"><b>Ingredient Name</b></td>
                        <td>{{ $ingredient->name }}</td>                        
                    </tr>
                    <tr>
                        <td style="text-align:left"><b>Ingredient Name</b></td>
                        <td>{{ $ingredient->ingredientCode }}</td>                        
                    </tr>                    
                    <tr>
                        <td style="text-align:left"><b>Description</b></td>
                        <td>{{ $ingredient->description }}</td>                        
                    </tr>
                    <tr>
                        <td style="text-align:left"><b>Price</b></td>
                        <td>{{ $ingredient->price }}</td>                        
                    </tr>                                        
                  </table>
                  <a href="{{ route( 'ingredient.edit', $ingredient->id ) }} ">Edit</a>                             

            </div>
        </div>
    </body>
</html>
