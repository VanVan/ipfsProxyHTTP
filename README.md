[![Website ipns.co](https://img.shields.io/website-up-down-green-red/http/ipns.co.svg?label=ipns.co)](http://ipns.co/)
[![Website getipfs.com](https://img.shields.io/website-up-down-green-red/http/getipfs.com.svg?label=getipfs.com)](http://getipfs.com/)
![NAC-depend-none](https://img.shields.io/badge/dependency-none-green.svg)
[![NAC-packagist](https://img.shields.io/packagist/v/vanvan/ipfs-proxy-http.svg)](https://packagist.org/packages/vanvan/ipfs-proxy-http)
[![GitHub version](https://badge.fury.io/gh/VanVan%2FipfsProxyHTTP.svg)](https://github.com/VanVan/ipfsProxyHTTP)
![PHP from Packagist](https://img.shields.io/packagist/php-v/vanvan/ipfs-proxy-http.svg)
[![NAC-license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/VanVan/ipfsProxyHTTP/blob/master/LICENSE)

IPNS.co | InterPlanetary File System HTTP Proxy
=======================

> IPNS.co is a very fast proxy to redirect HTTP Query to several IPFS Public gateway HTTP server.

This implementation can help developers to use only one URL to all IPFS files without any risk of breaking the server bandwidth. You can be sure that the servers capacity is large enough to handle all traffic.
 

This code has been written without any dependancy to run as faster as possible.
IPNS.co use DNSSEC, DNS Anycast, low latency DNS and IP resolved to different servers to handle all trafic.

Each IPFS gateway can break if a lot of files is downloaded simultaneous, this can help to avoid this risk.


To run your own instance of ipfsProxyHTTP (updated by Git Pull), you only only require PHP>=5.6 and a Web server.


## Usage 

```
https://ipns.co/<hash>
http://ipns.co/ipfs/<hash>
http://ipns.co/ipns/<hash>
```
Example:
```
https://ipns.co/QmYwAPJzv5CZsnA625s3Xf2nemtYgPpHdWEz79ojWnPbdG/readme
https://ipns.co/ipfs/QmYwAPJzv5CZsnA625s3Xf2nemtYgPpHdWEz79ojWnPbdG/readme

```

Or use it for your web file

```
<img src="https://ipns.co/QmZiSAYkU7gZtqYeZWL21yuwgFtRnJu1JjDzR6Qd2qdDBr/static/img/go-ipfs.png"  />
```
<img src="https://ipns.co/QmZiSAYkU7gZtqYeZWL21yuwgFtRnJu1JjDzR6Qd2qdDBr/static/img/go-ipfs.png"  />
 
 
  
> Alternative URL: getipfs.com

## Contributing

You can add your public ipfs gateway by making a PR to add it to gateway.txt


## Copyright and license

Code released under the [MIT License](https://github.com/VanVan/ipfsProxyHTTP/blob/master/LICENSE).