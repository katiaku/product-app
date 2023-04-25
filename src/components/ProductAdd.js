import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import axiosInstance from '../axiosInstance';

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

    const PRODUCT_TYPES = {
        DVD: (
            <label>
                Size (MB):
                <input
                    id="size"
                    type="text"
                    value={size}
                    onChange={(event) => setSize(event.target.value)}
                    required
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
                        required
                    />
                </label>
                <label>
                    Width (CM):
                    <input
                        id="width"
                        type="text"
                        value={width}
                        onChange={(event) => setWidth(event.target.value)}
                        required
                    />
                </label>
                <label>
                    Length (CM):
                    <input
                        id="length"
                        type="text"
                        value={length}
                        onChange={(event) => setLength(event.target.value)}
                        required
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
                    required
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
        event.preventDefault();

        if (
            !sku || 
            !productName || 
            !price || 
            !productType || 
            !productAttribute
        ) {
            setErrorMessage('Please, submit required data');
            return;
        }

        if (
            typeof sku !== 'string' || 
            typeof productName !== 'string' || 
            typeof price !== 'number' || 
            typeof productAttribute !== 'string'
        ) {
            alert('Please, provide the data of indicated type');
            return;
        }

        try {
            const response = await axiosInstance.get('/checkSku.php?sku=' + sku);
            if (response.data.exists) {
                setSkuError('SKU already exists');
                return;
            } else {
                setSkuError('');
            }
        } catch (error) {
            console.log(error);
        }

        try {
            await axiosInstance.post('/addProduct.php', {
                sku,
                productName,
                price,
                productType,
                productAttribute
            });
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <div>
            <header>
                <h1>Product Add</h1>
                <Link to="/">
                    <button type='submit'>Save</button>
                </Link>
                <Link to="/">
                    <button>Cancel</button>
                </Link>
            </header>
            <hr></hr>
            <form id='product_form' onSubmit={handleSubmit}>
                <label>
                    SKU
                    <input
                        id="sku"
                        type="text"
                        value={sku}
                        onChange={(event) => setSku(event.target.value)}
                        required
                    />
                </label>
                <label>
                    Name
                    <input
                        id="name"
                        type="text"
                        value={productName}
                        onChange={(event) => setProductName(event.target.value)}
                        required
                    />
                </label>
                <label>
                    Price ($)
                    <input
                        id="price"
                        type="text"
                        value={price}
                        onChange={(event) => setPrice(event.target.value)}
                        required
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
