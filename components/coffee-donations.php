<?php
?>

<div class="focostv-coffee-donations">
    <h4 class="focostv-coffee-donations-title">
        Muchas horas de investigaci&oacute;n y desvelos hicieron posible este contenido.
    </h4>
    <p class="focostv-coffee-donations-text">
        Inv&iacute;tanos a un caf&eacute; y apoya nuestro compromiso con el periodismo de calidad.
    </p>

    <div class="focostv-coffee-donations-quantity">
        <div class="coffee-donations-icon">
            ☕️
        </div>
        <div>
            X
        </div>
        <div class="coffee-donations-quantity">
            <div class="custom-number-input">
                <button>-</button>
                <input type="number" id="quantity" value="1" min="1" />
                <button>+</button>
            </div>
        </div>
    </div>
    <div class="focostv-coffee-donations-button-container">
        <button class="focostv-coffee-donations-button">
            Apoyar $2
        </button>
    </div>
</div>

<style>
    .focostv-coffee-donations {
        background-color: #F8F8F7;
        border-radius: 0.25rem;
        padding: 1rem;
    }

    .focostv-coffee-donations-title {
        font-size: 1.75rem;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        color: #0F0F0F;
        margin: 0;
    }

    .focostv-coffee-donations-text {
        font-family: 'Inter', sans-serif;
        font-size: 1.125rem;
        color: #0F0F0F;
    }

    .focostv-coffee-donations-quantity {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-left: 3rem;
        padding-right: 3rem;
        font-family: 'Inter', sans-serif;
        font-size: 1.125rem;
        margin-bottom: 0.75rem;
    }

    .custom-number-input {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 120px;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
    }

    .custom-number-input input {
        width: 50px;
        text-align: center;
        border: none;
        font-size: 18px;
    }

    .custom-number-input button {
        background-color: white;
        border: none;
        font-size: 18px;
        padding: 8px;
        cursor: pointer;
        border-left: 1px solid #ccc;
    }

    .custom-number-input button:first-child {
        border-right: 1px solid #ccc;
    }

    .custom-number-input button:focus,
    .custom-number-input input:focus {
        outline: none;
    }

    .focostv-coffee-donations-button {
        background-color: #0F0F0F;
        border-radius: 0.5rem;
        padding: 1rem;
        color: #D9D9D9;
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
        width: 100%;
    }
</style>