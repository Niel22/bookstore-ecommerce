     foreach($allProdcuts as $products) {
            $path  = 'admin-panel/products-admins/books';
            //$file = $products->pro_file;

            for($i=0; $i < count($allProdcuts); $i++) {
              
                $mail->addAttachment($path . "/" . $products->pro_file);         //Add attachments

            }
        }