import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axiosInstance from '../axiosInstance';

export default function ProductList() {

    const [productList, setProductList] = useState([]);
	const [selectedProducts, setSelectedProducts] = useState([]);

    useEffect(() => {
        axiosInstance.get('/')
		.then(response => {
			setProductList(response.data);
		})
        .catch(error => {
            console.log(error);
        });
    }, []);

    const handleCheckbox = (event, product) => {
		const { checked } = event.target;
		const updatedProducts = [...selectedProducts];
		if (checked) {
		    updatedProducts.push(product);
		} else {
		    const index = updatedProducts.findIndex(p => p.sku === product.sku);
		    updatedProducts.splice(index, 1);
		}
		setSelectedProducts(updatedProducts);
    }

    const massDelete = () => {
		axiosInstance.delete('/', { data: selectedProducts.map(p => p.sku) })
		.then(response => {
		    setSelectedProducts([]);
		    setProductList(productList.filter(p => !selectedProducts.includes(p)));
		})
		.catch(error => {
		    console.log(error);
		});
    }

    return (
        <div>
            <header>
                <h1>Product List</h1>
                <Link to="/product-add">
                    <button>ADD</button>
                </Link>
                <button id="delete-product-btn" onClick={massDelete}>MASS DELETE</button>
            </header>
            <hr></hr>
            <section>
                {productList.map(product => {
                    return (
                        <div key={product.sku}>
                            <input 
                                type="checkbox" 
                                className="delete-checkbox" 
                                checked={selectedProducts.includes(product)} 
                                onChange={event => 
                                    handleCheckbox(event, product)
                                }>
                            </input>
                            <p>{product.sku}</p>
                            <p>{product.productName}</p>
                            <p>{product.price}</p>
                            <p>{product.productAttribute}</p>
                        </div>
                    )
                })}
            </section>
            <footer>
                <p>Scandiweb Test assignment</p>
            </footer>
        </div>
    )
}
