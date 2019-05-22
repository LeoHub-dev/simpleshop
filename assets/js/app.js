var shopProducts = new Vue({
	el: '#shopProducts',
	data: {
		loader: true,
		loaderCart: true,
		newCartProduct: {
			id: '',
			qty: 0
		},
		products: [],
		categories: [],
		shoppingCart: []
	},
	methods: {
		getShoppingCart: function () {
			this.loaderCart = true;
			this.$http.get('index.php/shop/getShoppingCart/').then(function (response) {
				console.log(response.body);
				this.shoppingCart = response.body;
				this.loaderCart = false;
			}, function () {
				alert('No se ha podido obtener el carro de compras');
			});
		},
		getCategories: function () {
			this.$http.get('index.php/shop/getCategories/').then(function (response) {
				this.categories = response.body;
				this.loader = false;
			}, function () {
				alert('No se ha podido obtener las categorias');
			});
		},
		getProducts: function (category = '') {
			this.loader = true;
			this.$http.get('index.php/shop/getProducts/' + category).then(function (response) {
				this.products = response.body;
				this.loader = false;
			}, function (error) {
				console.log(error);
				alert('No se ha podido obtener los productos');
			});
		},
		addToCart: function (id,qty) {
			this.$http.get('index.php/shop/addToCart/' + id + '/' +  qty).then(function (response) {
				console.log(response);
				this.getShoppingCart();
			}, function (error) {
				console.log(error);
				alert('No se ha podido crear la tarea.');
			});
		},
		lessItem: function (id_item) {
			var temp = this.shoppingCart.items[this.shoppingCart.items.findIndex(item => item.id == id_item)];
			temp.qty = parseInt(temp.qty) - 1;
			this.shoppingCart.items[this.shoppingCart.items.findIndex(item => item.id == id_item)] = temp;
			var total = 0;
			this.shoppingCart.items.forEach(function (item){
				total = total + (item.price * item.qty)
			})
			this.shoppingCart.total = total;

			this.$http.get('index.php/shop/addToCart/' + id_item + '/-1').then(function (response) {
				//this.getShoppingCart();
			}, function (error) {
				console.log(error);
				alert('No se ha podido crear la tarea.');
			});
		},
		moreItem: function (id_item) {
			var temp = this.shoppingCart.items[this.shoppingCart.items.findIndex(item => item.id == id_item)];
			temp.qty = parseInt(temp.qty) + 1;
			this.shoppingCart.items[this.shoppingCart.items.findIndex(item => item.id == id_item)] = temp;
			var total = 0;
			this.shoppingCart.items.forEach(function (item){
				total = total + (item.price * item.qty)
			})
			this.shoppingCart.total = total;

			this.$http.get('index.php/shop/addToCart/' + id_item + '/1').then(function (response) {
				//this.getShoppingCart();
			}, function (error) {
				console.log(error);
				alert('No se ha podido crear la tarea.');
			});
		},
		endShopping: function () {
			this.loader = true;
			this.$http.get('index.php/shop/endshopping/').then(function (response) {
				this.loader = false;
				this.getShoppingCart();
			}, function (error) {
				console.log(error);
				alert('No se ha podido crear la tarea.');
			});
		},
	},
	created: function () {
		this.getShoppingCart();
		this.getProducts();
		this.getCategories();
	}
});
