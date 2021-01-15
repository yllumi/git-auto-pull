# Git Auto Pull

File buat ngepullnya adalah file `pull.sh`. File ini nanti didaftarkan di cron. Contoh kode cronnya:

```
* * * * * cd /var/www/html/git-auto-pull/ && ./pull.sh
```

## Cara Pakai

Daftarkan dulu repo yang ingin diautopull di file `public/repos` dengan format:

```
namarepo /absolute/path/ke/reponya branch
```

misalnya:

```
codepolitan /var/www/codepolitan.com master
```

Setelah itu, daftarkan di webhook github, endpoint untuk memberitahu si pull.sh supaya ngepull. URL endpointnya mengarah ke file `public/index.php` dengan query string `?name=namarepo`. Misalnya, di server dipasang di IP `10.10.10.10/autopull/public/index.php?name=codepolitan`.

Nanti setiap kali endpoint ini dipanggil, aplikasi akan membuat file dengan nama `codepolitan` di dalam folder `mark/` yang akan menjadi penanda supaya si puller ngepull repo `codepolitan`.

Kamu bisa mendaftarkan banyak repo ke dalam file `public/repos` sebanyak repo yang ada di servermu.

Yeaaaah!