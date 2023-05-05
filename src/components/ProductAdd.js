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

    const [errorMessage, setErrorMessage] = useState(false);
    const [typeError, setTypeError] = useState(false);
    const [skuError, setSkuError] = useState(false);

    const navigate = useNavigate();

    const PRODUCT_TYPES = {
        DVD: (
            <label>
                Size (MB):
                <input
                    id="size"
                    type="text"
                    placeholder='Please, provide size'
                    value={size}
                    onChange={(event) => setSize(event.target.value)}
                />
            </label>
        ),
        Furniture: (
            <>
                <label>
                    Height (CM):
                    <input
                        id="height"
                        type="text"
                        placeholder='Please, provide dimensions'
                        value={height}
						onChange={(event) => setHeight(event.target.value)}
                    />
                </label>
                <label>
                    Width (CM):
                    <input
                        id="width"
                        type="text"
                        placeholder='Please, provide dimensions'
                        value={width}
						onChange={(event) => setWidth(event.target.value)}
                    />
                </label>
                <label>
                    Length (CM):
                    <input
                        id="length"
                        type="text"
                        placeholder='Please, provide dimensions'
                        value={length}
						onChange={(event) => setLength(event.target.value)}
                    />
                </label>
            </>
        ),
        Book: (
            <label>
                Weight (KG):
                <input
                    id="weight"
                    type="text"
                    placeholder='Please, provide weight'
                    value={weight}
                    onChange={(event) => setWeight(event.target.value)}
                />
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
                setErrorMessage(true);
            }
    
            /* if (typeof sku !== 'string' || typeof productName !== 'string' || isNaN(price) || typeof productAttribute !== 'string') {
                setTypeError(true);
            } */

            /* const response = await axiosInstance.get(`/product-add?sku=${sku}`);

            if (response.data.exists) {
                setSkuError(true);
            } */

            const productJson = CircularJSON.stringify({ sku, productName, price, productType, productAttribute });
            const addProductResponse = await axiosInstance.post('/product-add', productJson);
            console.log('Product added: ', addProductResponse.data);
			
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
                        id="name"
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
                {skuError && (
                    <p className="error-message">Provided SKU already exists</p>
                )}
                {errorMessage && (
                    <p className="error-message">Please, submit required data</p>
                )}
                {typeError && (
                    <p className="error-message">Please, provide the data of indicated type</p>
                )}
            </form>
            <footer>
                <p>Scandiweb Test assignment</p>
            </footer>
        </div>
    )
}
