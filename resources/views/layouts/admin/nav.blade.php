  <div class="row" style="padding-top: 3px">
    
  </div>

  <nav class="navbar navbar-inverse" style="background-color: #000000">
      <div class="container-fluid" style="margin-left: 60px;">

        <ul class="nav navbar-nav">
          <li><a href="{{ URL('admin/dashboard') }}">Dashboard</a></li>          
          <li><a href="{{ URL('admin/stats') }}">Stats Analytica</a></li>
          <li>
            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('cuisine.index') }}">Cuisine
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('cuisine.index') }}">All Cuisines</a></li>
              <li><a href="{{ route('cuisine.create') }}">Add Cuisine</a></li>
            </ul>          
          </li> 
          <li>
            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('category.index') }}">Category
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('category.index') }}">All categories</a></li>
              <li><a href="{{ route('category.create') }}">Add Category</a></li>
            </ul>          
          </li> 
          <li>
            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('item.index') }}">Products
            <span class="caret"></span></a>
            <ul class="dropdown-menu">        
              <li><a href="{{ route('product.index') }}">All Products</a></li>
              <li><a href="{{ route('product.create') }}">Add Product</a></li>
              <li><a href="{{ url('product/listing') }}">Update Product Listing</a></li>                  
            </ul>          
          </li> 
          <li>
            <a class="dropdown-toggle" data-toggle="dropdown" href="{{ route('item.index') }}">Serving Items
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('item.index') }}">All Serving Items</a></li>
              <li><a href="{{ url('item/create/ingredient') }}">Add Ingredient</a></li>
              <li><a href="{{ url('item/create/accessory') }}">Add Accessory</a></li>
              <li><a href="{{ url('item/create/sideDish') }}">Add Side Dish</a></li>                            
            </ul>          
          </li> 

        </ul>
      </div>
    </nav>
