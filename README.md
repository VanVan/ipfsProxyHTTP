[![Website ipns.co](https://img.shields.io/website-up-down-green-red/http/ipns.co.svg?label=ipns.co)](http://ipns.co/)
[![Website getipfs.com](https://img.shields.io/website-up-down-green-red/http/getipfs.com.svg?label=getipfs.com)](http://getipfs.com/)
![NAC-depend-none](https://img.shields.io/badge/dependency-none-green.svg)
[![NAC-packagist](https://img.shields.io/packagist/v/vanvan/ipfs-proxy-http.svg)](https://packagist.org/packages/vanvan/ipfs-proxy-http)
[![GitHub version](https://badge.fury.io/gh/VanVan%2FipfsProxyHTTP.svg)](https://github.com/VanVan/ipfsProxyHTTP)
![PHP from Packagist](https://img.shields.io/packagist/php-v/vanvan/ipfs-proxy-http.svg)
[![NAC-license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/VanVan/ipfsProxyHTTP/blob/master/LICENSE)


<a href="https://ipns.co/">
    <img src="https://ipns.co/QmZiSAYkU7gZtqYeZWL21yuwgFtRnJu1JjDzR6Qd2qdDBr/static/img/go-ipfs.png" alt="IPFS logo" title="IPFS logo" align="right" height="90" /></a>

IPNS.co | InterPlanetary File System HTTP Proxy
=======================

> IPNS.co is a very fast proxy to redirect HTTP Query to several IPFS Public gateway HTTP server.

This implementation can help developers to use only one URL to all IPFS files without any risk of breaking the server bandwidth. You can be sure that the servers capacity is large enough to handle all traffic.
 

This code has been written without any dependency to run as faster as possible.
IPNS.co use DNSSEC, DNS Anycast, low latency DNS and IP resolved to different servers to handle all trafic.

Each IPFS gateway can break if a lot of files is downloaded simultaneous, this can help to avoid this risk.


To run your own instance of ipfsProxyHTTP (updated by Git Pull), you only only require PHP>=5.6 and a Web server.

## ▶️ [Usage](#usage)

```
https://ipns.co/<hash>
http://ipns.co/ipfs/<hash>
http://ipns.co/ipns/<hash>
```
🔗 Example:
```
https://ipns.co/QmYwAPJzv5CZsnA625s3Xf2nemtYgPpHdWEz79ojWnPbdG/readme
https://ipns.co/ipfs/QmYwAPJzv5CZsnA625s3Xf2nemtYgPpHdWEz79ojWnPbdG/readme

```

Or use it for your web file

```
<img src="https://ipns.co/QmZiSAYkU7gZtqYeZWL21yuwgFtRnJu1JjDzR6Qd2qdDBr/static/img/go-ipfs.png"  />
```
<img src="https://ipns.co/QmZiSAYkU7gZtqYeZWL21yuwgFtRnJu1JjDzR6Qd2qdDBr/static/img/go-ipfs.png"  />
 
 
  
> ⏩ Alternative URL: <a href="http://getipfs.com">getipfs.com</a>, <a href="http://ipns.co">ipns.co</a>


## 🔧 [Installation](#install)

It is ready to use if you have installed docker.

```
docker run -p 80:80 -p 443:443 wandrille/ipfs-proxy-http:1.0
```
or
```
git clone https://github.com/VanVan/ipfsProxyHTTP
cd ipfsProxyHTTP
docker-compose up
```

Otherwise, all you need is a basic web server with at least PHP 5.6.

## 💡 Features

### For everyone hosting this code

* Very fast proxy
* Avoid breaking the server bandwidth limit
* No dependency
* Handle a lot of simultaneous requests


### And for IPNS.co and getIPFS.com

* CORS
* Origin Isolation (Subdomain Gateway)
* IPNS and DNSLink
* Load balancing
* DDOS protection
* DNSSEC
* DNS Anycast
* Low latency DNS

## ✏️ Contributing

You can add your public ipfs gateway by making a PR to add it to gateway.txt


## 🎓 Copyright and license

Code released under the [MIT License](https://github.com/VanVan/ipfsProxyHTTP/blob/master/LICENSE).
