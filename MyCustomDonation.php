<?php
/**
 * Plugin Name: My Custom Donation
 * Description: Bu eklenti, özel bir bağış formu oluşturmanıza olanak tanır.
 * Version: 1.0
 * Author: Ali Vahap AYDIN
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Erişim engellendi
}

class My_Custom_Donation {
    public function __construct() {
        add_shortcode( 'custom_donation_form', array( $this, 'donation_form_shortcode' ) );
    }

public function donation_form_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'title' => 'Bağış Yap',
        'description' => 'Bağış yapmak için lütfen aşağıdaki formu doldurun.',
    ), $atts );

    ob_start(); ?>

       <style>
        .donation-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .donation-form h2 {
            margin-top: 0;
        }
        .donation-form p {
            margin-bottom: 20px;
        }
        .donation-form label {
            display: block;
            margin-bottom: 10px;
        }
        .donation-form .donation-amount-buttons {
            margin-bottom: 15px;
        }
        .donation-form .donation-amount-buttons button {
            margin-right: 10px;
            margin-bottom: 10px;
            padding: 10px 15px;
            border: 1px solid #007bff;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        .donation-form .donation-amount-buttons button:hover {
            background-color: #0056b3;
        }
        .donation-form .donation-amount-buttons button.active {
            background-color: #0056b3;
        }
        .donation-form input[type="text"],
        .donation-form input[type="submit"] {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
		 .payment-form {
            display: none;
        }
        .show-payment-form {
            display: block;
        }
  
    </style>

    <div class="donation-form">
        <h2><?php echo esc_html( $atts['title'] ); ?></h2>
        <p><?php echo esc_html( $atts['description'] ); ?></p>

        <label for="donation_amount">Bağış Miktarı:</label>
        <div class="donation-amount-buttons">
            <button class="donation-amount-option" data-amount="7000">7000 TL</button>
            <button class="donation-amount-option" data-amount="8000">8000 TL</button>
            <button class="donation-amount-option" data-amount="9000">9000 TL</button>
            <button class="donation-amount-option" data-amount="10000">10000 TL</button>
        </div>
        <label for="custom_donation_amount">Veya Özel Tutar Girin:</label>
        <input type="text" id="custom_donation_amount" name="custom_donation_amount">
        <button id="show-payment-form">Bağış Yap</button>

        <div class="payment-form">
            <h2>Ödeme Bilgileri</h2>
            <form action="" method="post">
                <label for="full_name">Ad Soyad:</label>
                <input type="text" id="full_name" name="full_name" required>

                <label for="email">E-Posta:</label>
                <input type="email" id="email" name="email" required>

                <label for="card_number">Kredi Kartı Numarası:</label>
                <input type="text" id="card_number" name="card_number" required>

                <label for="expiration_date">Son Kullanma Tarihi:</label>
                <input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YY" required>

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" required>

                <input type="submit" name="submit_donation" value="Ödemeyi Tamamla">
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.donation-amount-option').forEach(function (button) {
                button.addEventListener('click', function () {
                    document.querySelector('#custom_donation_amount').value = this.getAttribute('data-amount');
                });
            });

            document.getElementById('show-payment-form').addEventListener('click', function () {
                var paymentForm = document.querySelector('.payment-form');
                paymentForm.classList.toggle('show-payment-form');
            });
        });
    </script>




    <?php
    return ob_get_clean();
}
	
}

new My_Custom_Donation();



