import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import axiosInstance from '../axiosInstance';
import CircularJSON from 'circular-json';

export default function ProductAdd() {

    const [sku, setSku] = useState('');
    const [productName, setProductName] = useState('');
    const [price, setPrice] = useState('');
    const [productType, setProductType] = useState('');
    const [size, setSize] = useState('');
    const [weight, setWeight] = useState('');
    const [height, setHeight] = useState('');
    const [width, setWidth] = useState('');
    const [length, setLength] = useState('');

    const [errorMessage, setErrorMessage] = useState('');
    const [skuError, setSkuError] = useState('');
    const navigate = useNavigate();

    const PRODUCT_TYPES = {
        DVD: (
            <label>
                Size (MB):
                <input
                    id="size"
                    type="text"
                    value={size}
                    onChange={(event) => setSize(event.target.value)}
                />
                <span>Please, provide size</span>
            </label>
        ),
        Furniture: (
            <>
                <label>
                    Height (CM):
                    <input
                        id="height"
                        type="text"
                        value={height}
                        onChange={(event) => setHeight(event.target.value)}
                    />
                </label>
                <label>
                    Width (CM):
                    <input
                        id="width"
                        type="text"
                        value={width}
                        onChange={(event) => setWidth(event.target.value)}
                    />
                </label>
                <label>
                    Length (CM):
                    <input
                        id="length"
                        type="text"
                        value={length}
                        onChange={(event) => setLength(event.target.value)}
                    />
                </label>
                <span>Please, provide dimensions</span>
            </>
        ),
        Book: (
            <label>
                Weight (KG):
                <input
                    id="weight"
                    type="text"
                    value={weight}
                    onChange={(event) => setWeight(event.target.value)}
                />
                <span>Please, provide weight</span>
            </label>
        )
    };

    const productAttribute = PRODUCT_TYPES[productType];

    function handleTypeSwitcher(event) {
        setProductType(event.target.value);
    }

    async function handleSubmit(event) {
        try {
            event.preventDefault();
    
            if (!sku || !productName || !price || !productType || !productAttribute) {
                alert('Please, submit required data');
            }
    
            if (typeof sku !== 'string' || typeof productName !== 'string' || typeof productType !== 'string' || isNaN(price)) {
                alert('Please, provide the data of indicated type');
            }

            const productJson = CircularJSON.stringify({ sku, productName, price, productType, productAttribute });
    
            const response = await axiosInstance.get(`/checkSku.php?sku=${sku}`);
    
            if (response.data.exists) {
                alert('SKU already exists');
            }
    
            const addProductResponse = await axiosInstance.post('/addProduct.php', productJson);
            console.log('Product added:', addProductResponse.data);
            navigate('/');
        } catch (error) {
            console.log(error.message);
        }
    }

    return (
        <div>
            <header>
                <h1>Product Add</h1>
                <button type="submit" form="product_form">Save</button>
                <Link to="/">
                    <button>Cancel</button>
                </Link>
            </header>
            <hr></hr>
            <form id='product_form' onSubmit={(event) => {handleSubmit(event)}}>
                <label>
                    SKU
                    <input
                        id="sku"
                        type="text"
                        value={sku}
                        onChange={(event) => setSku(event.target.value)}
                    />
                </label>
                <label>
                    Name
                    <input
                        id="productName"
                        type="text"
                        value={productName}
                        onChange={(event) => setProductName(event.target.value)}
                    />
                </label>
                <label>
                    Price ($)
                    <input
                        id="price"
                        type="text"
                        value={price}
                        onChange={(event) => setPrice(event.target.value)}
                    />
                </label>
                <label>
                    Type Switcher
                    <select id="productType" value={productType} onChange={handleTypeSwitcher}>
                        <option value="Select">-- Select an option --</option>
                        <option value="DVD">DVD</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Book">Book</option>
                    </select>
                </label>
                {productAttribute}
            </form>
            <footer>
                <p>Scandiweb Test assignment</p>
            </footer>
        </div>
    )
}
