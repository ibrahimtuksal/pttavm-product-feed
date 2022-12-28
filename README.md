
# İbrahim Tuksal PTTAVM Assesment




## Bilgisayarınızda Çalıştırın

Projeyi klonlayın

```bash
  git clone https://github.com/ibrahimtuksal/pttavm-product-feed.git
```
Sunucuyu **php** ile çalıştırın 
```bash
  php -S localhost:8000
```


  
## Özellikler

- Formatlar JSON, XML
- Sağlayıcılar Google, Facebook
- Provider altında farklı bir sınıf açıp ProviderInterface kullanılarak yeni besleme oluşturucular yazılabilir.
- Eğer yeni bir besleme sağlayıcısı yazılacaksa Type\Provider içerisine yeni bir provider sabiti tanımlanmalı.

  
## Bilgilendirme


index.php dosyasında denemeler yapabilir
FeedService.php adlı dosyadan her şeyi yönetebilirsiniz
Örnek Kullanım;
```php
try {
    $feedService->create(Format::JSON, Provider::FACEBOOK, $products);
} catch (Exception $e) {
    echo $e->getMessage();
}
```

  