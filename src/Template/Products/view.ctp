<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>
    .logo-container {
        display: flex;
        align-items: center; 
        justify-content: center;
        width: 100%;
        position: relative;
    }

    img {
        margin-right: 10px;
        width : 100px;
        height : 100px;
        border-radius : 70%;
    }

    .search-setup {
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 200px;
        /* margin-left: 400px; */
    }
    a{
        font-size : 50px;
        color : silver;
    }
    nav{
        background-color: grey;
    }
    ul{
        list-style-type:none;
        display: flex; 
        justify-content: space-between; 
        align-items: center;
    }
    .logout_button{
        font-size:18px;
        font-weight: bold;
        margin-right: 20px;
    }
    .add_button{
        margin-left : 150px;
    }
    .products{
        margin: 25px 100px;
        padding: 20px;
        text-align: center;
    }
    th{ 
        padding : 10px;
        text-align: center;
    }
    td{
        margin : 10px;
        padding : 10px;
        text-align: center;
    }
    h1{
        text-align: center;
    } 
    button{
        margin:5px;
    }  
    #update_info{
        color: green;
        font-size:18px;
        font-weight: bold;
        text-align: center;
    }
    #delete_info{
        color:red;
        font-size:18px;
        font-weight: bold;
        text-align: center;
    }
</style>

<nav class="top-bar expanded" data-topbar role="navigation">
        <div class="logo">
        <ul class="title-area large-3 medium-4 columns">
            <li class="logo">
                <?php echo $this->Html->image('logo.jpg') ?> 
            </li>
            <li>
                <input type="text" placeholder="Search.." class="search-setup">            
            </li>
            <li>
                <?php echo $this->Html->link('Logout', 'login', ['class' => 'btn btn-danger logout_button']) ?>
            </li>
        </ul>
        </div>
    
</nav>
<h1>Dashboard</h1>
<p id="delete_info"></p>
<?php echo $this->Html->link('Add New Product', 'add-product', ['class' => 'btn btn-success add_button']) ?>
<div class="products view large-9 medium-8 columns content">
    <table class="table table-striped vertical-table">
        <tr>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Product Brand</th>
            <th>Product Price</th>
            <th>Product Rating</th>
            <th>Actions</th>
        </tr>
    
    <?php 
    foreach ($products as $product){
        ?>
        <tr>
            <td><?php echo $product->product_name; ?></td>
            <td><?php echo $product->product_description; ?></td>
            <td><?php echo $product->product_brand; ?></td>
            <td><?php echo $product->product_price; ?></td>
            <td><?php echo ($product->product_rating)+1; ?></td>
            <td>
                <?php echo $this->Html->link('Update', 'edit-product/'.$product->id, ['class' => 'btn btn-primary update', 'value' => $product->id]).  $this->Form->button('Delete', ['type' => 'button', 'class' => 'btn btn-danger delete', 'value' => $product->id]); ?>
            </td>
        </tr>
    <?php 
    }
    ?>
    </table>
    
</div>
<script>
    $(document).ready(function() {
        $(".delete").click(function(event) {
            event.preventDefault();
            if(confirm('Are you sure you want to delete this product?')){
                var productId = $(this).val();
                $.ajax({
                    url: 'delete-product/'+productId,
                    type: 'POST', 
                    success: function(data) { 
                        $("#delete_info").text(data.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 5000);
                    },
                    error: function(xhr, status, error) {
                        $("#delete_info").text(error);
                    }
                });
            }
        });
    });
</script>