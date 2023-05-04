import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axiosInstance from '../axiosInstance';

export default function ProductList() {

    const [productList, setProductList] = useState([]);

    useEffect(() => {
        axiosInstance.get('/')
            .then(response => {
                if (response.status === 200) {
                    return response.data;
                } else {
                    console.log('Request failed with status code ' + response.status);
                }
            })
            .then(data => setProductList(data))
            .catch(error => {
                console.log(error);
        });
    }, []);

    const handleCheckbox = (event, productSku) => {
        const updatedProductList = productList.map(product => {
            if (product.sku === productSku) {
                return {
                    ...product,
                    checked: event.target.checked
                }
            }
            return product;
        });
        setProductList(updatedProductList)
    }

    const massDelete = () => {
        const selectedProducts = productList.filter(product => product.checked).map(product => product.sku);
        axiosInstance.post('/', { skus: selectedProducts })
            .then(response => {
                setProductList(productList.filter(product => !product.checked))
            })
            .catch(error => {
                console.log(error)
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
                                checked={product.checked} 
                                onChange={event => 
                                    handleCheckbox(event, product.sku)
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
