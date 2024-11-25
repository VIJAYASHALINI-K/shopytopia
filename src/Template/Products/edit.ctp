<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>
    .products{
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
    #update_info{
        font-size : 20px;
        color : green;
        font-weight: bold;
    }
    input[type="radio"] {
        margin-left: 10px;
        margin-right: 5px;
    } 
</style>

<nav class="top-bar expanded" data-topbar role="navigation">
    <?php echo $this->Html->image('logo.jpg') ?>   
</nav>
<div class="products form large-9 medium-8 columns content">
    <p id="update_info"></p>
    <?= $this->Form->create($product, ['class' => 'product', 'url' => ['action' => 'edit', $product->id]]) ?>    
    <fieldset>
        <legend><?= __('Update Product') ?></legend>
            <?php
                echo $this->Form->label('Product Name');
                echo $this->Form->control('product_name', array( 'label' => false));
                
                echo $this->Form->label('Product Description');
                echo $this->Form->control('product_description',array( 'label' => false));
                
                echo $this->Form->label('Product Brand');
                echo $this->Form->control('product_brand',array( 'label' => false));
                
                echo $this->Form->label('Product Price');
                echo $this->Form->control('product_price',array( 'label' => false));
    
                echo $this->Form->label('product_rating');
                echo $this->Form->radio('product_rating', [1, 2, 3, 4, 5]);
            ?>
    </fieldset>
    <?= $this->Form->button(__('Update'), ['class' => 'update_product btn btn-primary']) ?>
    <?= $this->Form->end() ?>
    <?php echo $this->Html->link('Cancel', 'dashboard', ['class' => 'btn btn-warning']) ?>
    
</div>
<script>
    $(document).ready(function() {
        $(".update_product").click(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                data: $(".product").serialize(),
                success: function(data) { 
                    $("#update_info").text(data.message);
                    setTimeout(function() {
                        window.location.href = '/dashboard';
                    }, 5000);
                },
                error: function(xhr, status, error) {
                    $("#update_info").text(error);
                }
            });
        });
    });
</script>