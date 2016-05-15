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
                    $accessory,                 
                      [
                        'method' => 'patch',
                        'route' => ['accessory.update', $accessory->id]
                      ]) 
                 }}

                   {{ Form::text('accessoryCode', $accessory->accessoryCode , array('placeholder'=>'Accessory Code') ) }}

                   <br/>

                   {{ Form::text('name' , $accessory->name, array('placeholder'=>'Accessory Name') ) }}

                   <br/>

                   {{ Form::text('description', $accessory->description, array('placeholder'=>'Description')) }}

                   <br/>

                   {{ Form::number('price', $accessory->price, array('placeholder'=>'Price')) }}

                   <br/>
                   
                   {{ Form::number('type', $accessory->type, array('placeholder'=>'Type')) }}

                   <br/>


                   {{ Form::submit('Update') }}

                {{ Form::close() }}



            </div>
        </div>
    </body>
</html>
