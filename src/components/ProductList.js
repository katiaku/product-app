import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios'

function ProductList() {

    const [productList, setProductList] = useState([]);

    useEffect(() => {
        axios.get('http://localhost/product-app/server/api/listProducts.php')
            .then(response => {
                setProductList(response.data);
            })
            .catch(error => {
                console.log(error);
            });
    }, []);

    const handleCheckbox = (event, productId) => {
        const updatedProductList = productList.map(product => {
            if (product.id === productId) {
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
        const selectedProducts = productList.filter(product => product.checked).map(product => product.id);
        axios.post('/api/delete-products.php', { ids: selectedProducts })
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
                <button onClick={massDelete}>MASS DELETE</button>
            </header>
            <hr></hr>
            <section>
                {productList.map(product => {
                    return (
                        <div key={product.id}>
                            <input type="checkbox" className="delete-checkbox" checked={product.checked} onChange={event => handleCheckbox(event, product.id)}></input>
                            <p>{product.getSku()}</p>
                            <p>{product.getProductName()}</p>
                            <p>{product.getPrice()}</p>
                            <p>{product.getProductTypeSpecificAttribute()}</p>
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

export default ProductList;
