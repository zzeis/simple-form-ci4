<script type="text/javascript">
    $(".telefone").mask("(00) 0000-00000");
</script>

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/css/home.css">
<script type="text/javascript" src="js/inputCPFcNPJ.js"></script>

<div class="home">

    <p class="text-center aviso"><i class="ri-alert-line"></i><br>Antes de se inscrever leia o decreto: <a  class='link' href="https://www.iguape.sp.gov.br/site/wp-content/uploads/2023/06/DECRETO_3_074.pdf">clique aqui</a></p>

    <div class="formulario w-72 sm:w-max lg:w-72 ">
        <form method="post" action="<?= base_url() ?>save">
            <label>Nome</label>
            <input type="text" name="nome" required>
            <label>CPF</label>
            <input type="text" id="cpf_cnpj" class="cpf_cnpj" name="cpf" required>
            <label>Email</label>
            <input type="email" name="email" required>
            <label>Celular</label>
            <input class='telefone' type="text" name="celular" required>
            <label>Qual o tipo de espaço? </label>
            <select onchange="StatusChange()" id='tipo' class="select" name="tipo" required='' required>
                <option value="">Selecione o espaço</option>
                <option value='tenda 5x5 diversos'>Tenda 5X5 - USO DIVERSOS</option>
                <option value='tenda 10x10 diversos'>Tenda 10X10 - USO DIVERSOS</option>
                <option value='box 28'>Box 28m² - Alimentação</option>

            </select>
            <label id="quantidadeLabel">Qual a Quantidade?</label>
            <input type="number" name="quantidade" required>

            <div class="radio">
                <input class='radio' id="contiguas" type="radio" name="estadoTenda" value="contiguas">
                <label for="contiguas">Contíguas</label><br>
                <input class='radio' type="radio" name="estadoTenda" value="separadas">
                <label for="contiguas">Separadas</label>
            </div>

            <input type="submit" class="botao" value="Enviar">
        </form>
    </div>

    <div class="descricao">
        <p class="title">Title example</p>
        <p class="texto">Subtitle  example</p>
        <p class="texto">Link or img</p>

        <ul class="social">

            <li>
                <a href="#"><i class="ri-facebook-circle-fill"></i></a>
            </li>
            <li>
                <a href="#"><i class="ri-youtube-line"></i></a>
            </li>


        </ul>
    </div>

</div>