<html>

<head>
	<meta charset="utf-8" />
	<title> Lista de productos </title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
</head>

<body>
	<div class="container">
		<h1> Lista de productos </h1>
		<hr>
		<form action="javascript:void(0);" id="shopProducts">
			<div v-if="categories.length > 0">
				<h2>Categorias</h2>
				<a href="javascript:void(0)" class="badge badge-primary ml-2" v-on:click="getProducts('')">Todos</a> <div v-for="category in categories" style="display:inline"><a href="javascript:void(0)" class="badge badge-primary ml-2" v-on:click="getProducts(category.id)">{{ category.name }}</a></div>
				<hr>
			</div>

			<div v-if="loader">
				Cargando ...
			</div>
			<div class="row" v-if="!loader">

				<div class="col-md-12" v-if="products.length > 0">
					<h2>Productos</h2>
				</div>
				<div v-if="products.length == 0">
					<p>No hay productos</p>
				</div>
				<div class="col-md-4" v-for="product in products">
					<div class="card">
						<div v-if="product.image != null">
							<img class="card-img-top mt-2" src="{{ product.image }}" alt="Card image cap">
						</div>
						<img class="card-img-top mt-2" v-if="!product.image" src="https://via.placeholder.com/290x180.png" alt="Card image cap">
						<div class="card-body">
							<h5 class="card-title">{{ product.name }}</h5>
							<p class="card-text">{{ product.description }}</p>
							<hr>
							<p class="card-text">Precio: {{ product.price }}</p>
							Cantidad: <input type="number" v-model="product.qty">
							<a href="javascript:void(0)" class="btn btn-primary mt-3" v-on:click="addToCart(product.id,product.qty)">Agregar al carrito</a>
						</div>
					</div>
				</div>
			</div>
			<div v-if="loaderCart">
				Cargando Carrito...
			</div>
			<table class="table mt-4" v-if="!loaderCart">
				<thead>
					<tr>
						<th> Nombre </th>
						<th> Descripción </th>
						<th> Cantidad </th>
						<th> Precio </th>
						<th> </th>
					</tr>
				</thead>
				<tbody>
					<!-- Fila para modificar una tarea. -->
					<tr v-for="item in shoppingCart.items">
						<td>
							{{ item.name }}
						</td>
						<td>
							{{ item.description }}
						</td>
						<td>
							<button v-on:click="lessItem(item.id)">-</button> {{ item.qty }} <button v-on:click="moreItem(item.id)">+</button>
						</td>
						<td>
							{{ item.qty * item.price }}
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td>
							Total: 
						</td>
						<td>
							{{ shoppingCart.total }}
						</td>
					
					</tr>
				</tfoot>
			</table>
			<button class="btn-block mt-3 mb-3" v-on:click="endShopping()"> Finalizar Compra </button>
		</form>
	</div>

	
	<script src="https://cdn.jsdelivr.net/npm/vue"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.5.1/vue-resource.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/app.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>
