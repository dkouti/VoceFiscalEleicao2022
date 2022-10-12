<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <!-- CSS only -->
    <!-- Title Page-->
    <title>VoceFiscal.com.br</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
 
    <!-- Main CSS-->
    <script src="jquery-2.1.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $.getJSON('estados_cidades.json', function(data) {
                var items = [];
                var options = '<option value="">escolha um estado</option>';
                $.each(data, function(key, val) {
                    options += '<option value="' + val.nome + '">' + val.nome + '</option>';
                });
                $("#estados").html(options);

                $("#estados").change(function() {

                    var options_cidades = '';
                    var str = "";

                    $("#estados option:selected").each(function() {
                        str += $(this).text();
                    });

                    $.each(data, function(key, val) {
                        if (val.nome == str) {
                            $.each(val.cidades, function(key_city, val_city) {
                                options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                            });
                        }
                    });
                    $("#cidades").html(options_cidades);

                }).change();

            });

        });
    </script>
    <link href="css/main.css" rel="stylesheet" media="all">
    <style>
        h1 {
            text-align: center;
        }

        h2 {
            text-align: left;
        }

        h3 {
            text-align: center;
            font-family: "Times New Roman", Times, serif;
            color: red;
            font-size: 20px;
        }

        .p1 {
            font-family: "Times New Roman", Times, serif;
            color: red;
            font-size: 12px;
        }

        #uploadForm label {
            margin: 2px;
            font-size: 1em;
        }

        #progress-bar {
            background-color: #12CC1A;
            color: #FFFFFF;
            width: 0%;
            -webkit-transition: width .3s;
            -moz-transition: width .3s;
            transition: width .3s;
            border-radius: 5px;
        }

        #targetLayer {
            width: 100%;
            text-align: center;
        }
    </style>


</head>

<body>

    <div class="wrapper wrapper--w680">
        <div class="card card-4">
            <div class="card-body">
                <h2 class="title" style="text-align: center;">Poste suas informaçoes</h2>
                <form action="upload.php" method="post" id="uploadForm">
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">Seu nome: (<font class="p1">Obrigatório.</font>)</label>
                                <input class="input--style-4" type="text" name="nome" required>
                            </div>
                        </div>
                    </div>








                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">Estado: (<font class="p1">Obrigatório.</font>)</label>
                                <select id="estados" name="estados" class="input--style-4">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">Cidade: (<font class="p1">Obrigatório.</font>)</label>
                                <select id="cidades" name="cidades" class="input--style-4">
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">Seção:</label>
                                <input class="input--style-4" type="text" name="secao">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <label class="label">Zona:</label>
                                <input class="input--style-4" type="text" name="zona">
                            </div>
                        </div>
                    </div>


                    <div class="input-group">
                        <div class="row">
                            <label class="label">Descrição da ocorrencia: (<font class="p1">Obrigatório.</font>)</label> <textarea name="descricao" class="input--style-4" rows="4" cols="40" required></textarea>
                        </div>
                    </div>


                    <div class="input-group">
                        <div class="row">
                            <label class="label">Envie video ou foto: (<font class="p1">Obrigatório.</font>)</label> <input name="userImage" id="userImage" type="file" class="full-width" required>
                            <font class="p1">Limite de 200MB.</font>
                            <font class="p1">NÃO POSTE FOTO OU VIDEO DO SEU VOTO/URNA.</font>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="row">


                            <label class="label">Declaro que estou de acordo com os <strong>Termos de uso.</label></strong>



                        </div>
                    </div>




                    <div class="p-t-15">
                        <input type="submit" value="Enviar" class="btn btn-info" />

                    </div>

                    <div class="row">
                        <div id="progress-bar"></div>
                    </div>
                    <div id="targetLayer"></div>
                </form>
                <div id="loader-icon" style="display: none;">
                    <img src="LoaderIcon.gif" />
                </div>
            </div>
        </div>
    </div>


    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>


    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#uploadForm').submit(function(e) {
                if ($('#userImage').val()) {
                    e.preventDefault();
                    $('#loader-icon').show();
                    $(this).ajaxSubmit({
                        target: '#targetLayer',
                        beforeSubmit: function() {
                            $("#progress-bar").width('0%');
                        },
                        uploadProgress: function(event, position, total, percentComplete) {
                            $("#progress-bar").width(percentComplete + '%');
                            $("#progress-bar").html('<div id="progress-status" class="text-center">' + percentComplete + ' %</div>')
                        },
                        success: function() {
                            $('#loader-icon').hide();
                        },
                        resetForm: true
                    });
                    return false;
                }
            });
        });
    </script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->