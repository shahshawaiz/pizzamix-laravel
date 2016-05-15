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
                <h2>Details</h2>

                  <table border="2">
                    <tr>
                        <td style="text-align:left"><b>Category Name</b></td>
                        <td>{{ $category->name }}</td>                        
                    </tr>
                    <tr>
                        <td style="text-align:left"><b>Description</b></td>
                        <td>{{ $category->description }}</td>                        
                    </tr>

                  </table>
                  <a href="{{ route( 'category.edit', $category->id ) }} ">Edit</a>                             

            </div>
        </div>
    </body>
</html>
