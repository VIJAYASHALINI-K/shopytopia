<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>
    .accounts{
        margin: 25px 50px;
        padding: 20px;
        text-align: center;
    }
    input,button{
        margin: 5px;
        padding: 5px;
    }

    img {
        margin-right: 10px;
        width : 100px;
        height : 100px;
        border-radius : 70%;
    }
    a{
        font-size : 50px;
        color : silver;
    }
    nav{
        background-color: grey;
    } 
    #login_info{
        font-size : 20px;
        color : green;
        font-weight: bold;
    }
    input[type="radio"] {
        margin-left: 10px;
        margin-right: 5px;
    } 
    #login_info2{
        font-size : 20px;
        color : red;
    }

</style>

<nav class="top-bar expanded" data-topbar role="navigation">
    <?php echo $this->Html->image('logo.jpg') ?>   
</nav>
<div class="accounts form large-9 medium-8 columns content">
    <?= $this->Form->create($account, ['class' => 'account', 'url' => ['action' => 'login']]) ?>    
    <fieldset>
        <legend><?= __('Login/Register') ?></legend>
            <?php
                echo $this->Form->control('email', array( 'label' => false, 'placeholder' => 'Email Address'));
                
                echo $this->Form->control('password',array( 'label' => false, 'placeholder' => 'Password'));
            ?>
    </fieldset>
    <?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary login']) ?>
    <?= $this->Form->end() ?>
    <p id="login_info"></p>  
    <p id="login_info2"></p>  
</div>
<script>
    $(document).ready(function() {
        $(".login").click(function(event) {
            event.preventDefault();
            $.ajax({
                url: 'login',
                type: 'POST',
                data: $(".account").serialize(),
                success: function(data) { 
                    if(data.message === "Login successfull" || data.message === "User is added"){
                        $("#login_info").text(data.message);
                        setTimeout(function() {
                            window.location.href = '/dashboard';
                        }, 3000);
                    }
                    else{
                        $("#login_info2").text(data.message);
                        setTimeout(function() {
                            window.location.href = '/';
                        }, 2000);
                    }
                },
                error: function(xhr, status, error) {
                    $("#login_info2").text(error);
                }
            });
        });
    });
</script>