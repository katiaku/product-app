import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import ProductList from './components/ProductList';
import ProductAdd from './components/ProductAdd';
import './styles.scss'


function App() {

	return (
		<Router>
			<Routes>
				<Route path="/" element={ <ProductList /> } />
				<Route path="/product-add" element={ <ProductAdd /> } />
			</Routes>
		</Router>
	);
}

export default App;
