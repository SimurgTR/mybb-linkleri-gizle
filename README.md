# MyBB Linkleri Gizle Eklentisi v1.0
MyBB'de konu ve gönderilerinizde ki iç ve dış linkleri belirleyeceğiniz gruplar, forumlar ve şartlara göre gizlemenizi ve yönetmenizi sağlar. Gizlenen linkler yerine belirlediğiniz uyarı mesajlarını gösterir.

# Neden Linkleri Gizle Eklentisini Tercih Etmelisiniz?
**Linkleri Gizle Eklentisi**, forumunuzdaki iç ve dış bağlantıları yönetmek için size tam kontrol sağlar. **SEO** stratejilerinizi destekler, kullanıcı gruplarına göre esnek ayarlar sunar ve özellikle ziyaretçi grubuna yönelik otomatik işaretleme ile spam veya istenmeyen bağlantıları en aza indirir.

# Eklenti Özellikleri
* **Esnek Rel Etiketi Yönetimi:** Yönetim panelinden nofollow, noopener, noreferrer gibi rel etiketlerini kolayca ayarlayabilirsiniz.
* **Hariç Tutulan Alan Adları:** Belirttiğiniz alan adları (örneğin, mybb.pro) ve alt alan adları (örneğin, subdomain.mybb.pro) için linkler hiçbir şekilde gizlenmez. Aynı alan adının www'lu ve www'suz versiyonları otomatik olarak tekilleştirilir.
* **Grup İzinleri:** Belirli kullanıcı gruplarına (örneğin, yöneticiler veya moderatörler) linklerin gizlenmemesini sağlayabilirsiniz. Ancak, ziyaretçi grubu (oturum açmamış kullanıcılar) için harici linkler her zaman gizlenir.
* **Hariç Tutulan Forumlar:** Seçtiğiniz forumlarda harici linkler ve eklentinin diğer kısıtlamaları işlevsiz hale gelir, seçilen forumlarda eklenti pasif durumda kalır.
* **Özel CSS** Eklenti ayarlarına bulunan Özel CSS alanı ile gizlenen linkler yerine gösterilen mesajları özelleştirebilirsiniz. Eklenti panelinde yaptığınız değişikler tüm temalarınıza uygulanacaktır.
* **Özel Uyarı Mesajları:** Gizlenen linkler yerine gösterilen mesajları eklenti ayarlarından özelleştirebilirsiniz.
* **İç Linkleri Gizleme Özelliği:** Eklenti varsayılan olarak sadece konularınızda ve gönderilerinizde paylaşılan harici (dış) linkleri gizler. Eklenti ayarlarından iç linklerin de gizlenmesini seçebilirsiniz. Böylelikle iç ve dış tüm bağlantılar gizlenecektir.
* **Gönderi Limiti:** Eklenti ayarlarından belirleyeceğiniz gönderi limiti ile linkleri gizleyebilirsiniz. Belirlediğiniz gönderi limitine sahip olmayan her kullanıcıya harici linkler gizlenir ve linkleri görebilmeleri için gerekli olan gönderi miktarını bildiren bir uyarı mesajı gösterilir. Gerekli gönderi sayısına sahip kullanıcılar herhangi bir kısıtlama olmadan linkleri görebilir.
* **Kolay Kurulum ve Yönetim:** Yönetim panelinden tüm ayarları hızlıca yapılandırabilirsiniz. Eklenti, MyBB 1.8.x sürümleriyle tam uyumludur.
* **Güvenlik ve Performans:**  noopener gibi etiketlerle güvenliği artırırken, optimize edilmiş kod yapısıyla forum performansını korur.

# Eklenti Nasıl Kurulur?
*  Eklenti dosyalarını **[buradan](https://mybb.pro/mybb-linkleri-gizle-eklentisi-v1-0.html)** veya Github üzerinden indirin.
*  İndirdiğiniz .zip dosyasını arşivden çıkarın.
*  Arşivden çıkan **/inc/** klasörünü forumunuzun kurulu olduğu ana dizine yükleyin.
*  Daha sonra MyBB Admin Kontrol Paneli -> Eklentiler -> Aktif Olmayan Eklentiler kısmından **Linkleri Gizle (1.0)** adlı eklentiyi Kur & Etkinleştir diyerek eklentiyi kurun.
*  Forum Ayarlar -> **Linkleri Gizle Eklenti Ayarları** adlı ayar grubundan eklentinin ayarlarını yapılandırabilirsiniz.

## Eklenti Nasıl Kaldırılır?
* MyBB Admin Kontrol Paneli -> Eklentiler -> Aktif Eklentiler kısmından **Linkleri Gizle (1.0)** adlı eklentiyi bulun ve Devredışı Bırak & Kaldır diyerek eklentiyi kaldırın.
* Daha sonra FTP'nize bağlanarak aşağıda listelenen dosyaları sunucunuzdan kaldırın.
* + **/inc/plugins/simurg_linkgizle.php**
  + **/inc/languages/turkish/admin/simurg_linkgizle.lang.php**
  + **/inc/languages/english/admin/simurg_linkgizle.lang.php**
 
* İlgili dosyaları FTP'den kaldırdığınız eklenti tamamen sitenizden kaldırılmış olacaktır.

# Eklenti Destek
Eklenti ile ilgili destek almak istiyorsanız [buraya](https://mybb.pro) tıklayın.
