# Git Auto Pull

File buat ngepullnya adalah file `pull.sh`. File ini nanti didaftarkan di cron. Contoh kode cronnya:

```
* * * * * cd /var/www/html/git-auto-pull/ && ./pull.sh
```

## Cara Pakai

Copas file `public/repos.bak` dengan nama `public/repos`.
Daftarkan dulu repo yang ingin diautopull di file `public/repos` dengan format:

```
namaproject /absolute/path/ke/reponya branch
```

misalnya:

```
codepolitan /var/www/codepolitan.com master
```

Untuk menjalankan pull, tinggal panggil endpoint ini:

`10.10.10.10/git-auto-pull/public/index.php?name=codepolitan`

URL endpointnya mengarah ke file `public/index.php` dengan query string `?name=namaproject`.
Nanti setiap kali endpoint ini dipanggil, aplikasi akan membuat file dengan nama `codepolitan` di dalam folder `mark/` yang akan menjadi penanda supaya si puller ngepull repo `codepolitan`. Si puller hanya ngepull branch yang sudah didaftarkan di file `public/repos` tadi.

Kamu bisa mendaftarkan banyak repo ke dalam file `public/repos` sebanyak repo yang ada di servermu.

Endpoint di atas bisa kamu daftarkan di Github webhook supaya setiap kali kita ngepush ke repo, Github akan memanggilkan endpoint tersebut.

## Menggunakan Signature di Github Webhook

Biar lebih aman lagi, kita bisa mendaftarkan _secret_ pada saat membuat webhook di Github.

[](https://docs.github.com/assets/cb-11570/images/webhook_secret_token.png)

Tinggal masukkan kode secret yang kamu inginkan di kolom Secret webhook tersebut. Kemudian buat file `secret` di root folder puller ini dan isi dengan kode secret yang sama. Ini tujuannya supaya si puller memverifikasi terlebih dahulu apakah request untuk ngepull ini memang datang dari Github. Kalo signaturenya beda, tandanya endpoint dipanggil bukan oleh Github webhook.