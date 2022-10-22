<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="VocêFiscal" />
    <meta name="author" content="VocêFiscal" />
    <title>VocêFiscal</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
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
    <style>
        .vermelho {
            text-align: left;
            font-family: "Times New Roman", Times, serif;
            color: red;
            font-size: 13px;
        }

        .verde {
            text-align: left;
            font-family: "Times New Roman", Times, serif;
            color: green;
            font-size: 13px;
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


    <div class="container">






        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Poste suas informações</h4>


                <form action="../v2/upload.php" method="post" id="uploadForm">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="nome" class="form-control" placeholder="Seu nome" type="text" required>
                    </div>
                    <!-- form-group// -->



                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class='fas fa-map'></i> </span>
                        </div>
                        <select id="estados" name="estados" class="custom-select">
                            <<option value="">
                                </option>
                        </select>

                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class='fas fa-map'></i> </span>
                        </div>
                        <select id="cidades" name="cidades" class="custom-select">
                            <<option value="">
                                </option>
                        </select>

                    </div>
                    <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class='fas fa-laptop'></i> </span>
                        </div>
                        <input name="" class="form-control" placeholder="Seção eleitoral" type="secao">
                    </div>
                    <!-- form-group// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class='fas fa-laptop'></i> </span>
                        </div>
                        <input name="" class="form-control" placeholder="Zona eleitoral" type="zona">
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-list"></i> </span>
                        </div>
                        <textarea name="descricao" class="form-control" placeholder="Descrição do ocorrido" rows="4" cols="40" required></textarea>
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-file-image"></i> </span>
                        </div>
                        <input name="userImage" id="userImage" type="file" class="form-control" required>
                    </div> <!-- form-group// -->
                    <div class="form-group">

                        <ul>
                            <li class="vermelho">Não poste foto/vídeo da urna ou seu voto.</li>
                            <li class="vermelho">Limite de 200MB.</li>
                            <li class="verde">Você pode postar vídeo da sua galeria ou tirar foto.</li>
                        </ul>
                        

                        <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6Le_pJkiAAAAAFk447IrGQwVba0Sv2Cdw5Yv4-AF"></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" onclick="return valida()"> Enviar </button>
                    </div> <!-- form-group// -->
                    <div class="row">
                        <div id="progress-bar"></div>
                    </div>
                    <div id="targetLayer"></div>
                    <div id="loader-icon" style="display: none;">
                        <img src="LoaderIcon.gif" />
                    </div>
                </form>
            </article>
        </div> <!-- card.// -->

    </div>
    <!--container end.//-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
function valida()
    {
        if (grecaptcha.getResponse()==""){
            alert('Voce precisar marcar a caixinha');
            return false;
        }
    }

</script>
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

</body>

</html>