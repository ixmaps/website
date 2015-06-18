
var collectTrData = function(){

  var trDataString = JSON.stringify(TrTestJsonData);
  //console.log(TrTestJsonData);
  jQuery("#tr-json").val(trDataString); 
  ajaxObj = jQuery.ajax(url_base + '/application/controller/gather_tr.php', {
    type: 'POST',
    data: TrTestJsonData,
    success: function (e) {
      console.log("collectTrData: OK! ", e);
      jQuery("#tr-result").val(e);
    },
    error: function (e) {
      console.log("collectTrData: Error!");
      
    }
  });
}

var TrTestJsonData={
    "timeout": "1000",
    "queries": "4",
    "dest": "ixmaps.ca",
    "dest_ip": "142.150.149.197",
    "submitter": "lodeanto.ixnode",
    "postal_code": "m1m",
    "maxhops": "30",
    "os": "Darwin",
    "traceroute_submissions": [
        {
            "client": "ixjs 0.0.1",
            "protocol": "ICMP",
            "tr_data": [
                [
                    {
                        "pass": 1,
                        "hop": 1,
                        "ttl": 1,
                        "ip": "192.168.0.1",
                        "rtt": "3.70"
                    },
                    {
                        "pass": 1,
                        "hop": 2,
                        "ttl": 2,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 3,
                        "ttl": 3,
                        "ip": "209.148.244.45",
                        "rtt": "38.69"
                    },
                    {
                        "pass": 1,
                        "hop": 4,
                        "ttl": 4,
                        "ip": "69.63.249.229",
                        "rtt": "13.23"
                    },
                    {
                        "pass": 1,
                        "hop": 5,
                        "ttl": 5,
                        "ip": "69.196.136.132",
                        "rtt": "57.80"
                    },
                    {
                        "pass": 1,
                        "hop": 6,
                        "ttl": 6,
                        "ip": "206.108.34.207",
                        "rtt": "14.87"
                    },
                    {
                        "pass": 1,
                        "hop": 7,
                        "ttl": 7,
                        "ip": "205.211.94.134",
                        "rtt": "63.56"
                    },
                    {
                        "pass": 1,
                        "hop": 8,
                        "ttl": 8,
                        "ip": "128.100.96.9",
                        "rtt": "54.37"
                    },
                    {
                        "pass": 1,
                        "hop": 9,
                        "ttl": 9,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 10,
                        "ttl": 10,
                        "ip": "142.150.148.1",
                        "rtt": "14.23"
                    },
                    {
                        "pass": 1,
                        "hop": 11,
                        "ttl": 11,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 12,
                        "ttl": 12,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 13,
                        "ttl": 13,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 14,
                        "ttl": 14,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 15,
                        "ttl": 15,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 16,
                        "ttl": 16,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 17,
                        "ttl": 17,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 18,
                        "ttl": 18,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 19,
                        "ttl": 19,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 20,
                        "ttl": 20,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 21,
                        "ttl": 21,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 22,
                        "ttl": 22,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 23,
                        "ttl": 23,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 24,
                        "ttl": 24,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 25,
                        "ttl": 25,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 26,
                        "ttl": 26,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 27,
                        "ttl": 27,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 28,
                        "ttl": 28,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 29,
                        "ttl": 29,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 30,
                        "ttl": 30,
                        "rtt": -1,
                        "err": "timeout"
                    }
                ],
                [
                    {
                        "pass": 2,
                        "hop": 1,
                        "ttl": 1,
                        "ip": "192.168.0.1",
                        "rtt": "30.72"
                    },
                    {
                        "pass": 2,
                        "hop": 2,
                        "ttl": 2,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 3,
                        "ttl": 3,
                        "ip": "209.148.244.45",
                        "rtt": "12.28"
                    },
                    {
                        "pass": 2,
                        "hop": 4,
                        "ttl": 4,
                        "ip": "69.63.249.229",
                        "rtt": "16.08"
                    },
                    {
                        "pass": 2,
                        "hop": 5,
                        "ttl": 5,
                        "ip": "69.196.136.132",
                        "rtt": "14.52"
                    },
                    {
                        "pass": 2,
                        "hop": 6,
                        "ttl": 6,
                        "ip": "206.108.34.207",
                        "rtt": "13.01"
                    },
                    {
                        "pass": 2,
                        "hop": 7,
                        "ttl": 7,
                        "ip": "205.211.94.134",
                        "rtt": "11.91"
                    },
                    {
                        "pass": 2,
                        "hop": 8,
                        "ttl": 8,
                        "ip": "128.100.96.9",
                        "rtt": "12.23"
                    },
                    {
                        "pass": 2,
                        "hop": 9,
                        "ttl": 9,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 10,
                        "ttl": 10,
                        "ip": "142.150.148.1",
                        "rtt": "16.50"
                    },
                    {
                        "pass": 2,
                        "hop": 11,
                        "ttl": 11,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 12,
                        "ttl": 12,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 13,
                        "ttl": 13,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 14,
                        "ttl": 14,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 15,
                        "ttl": 15,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 16,
                        "ttl": 16,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 17,
                        "ttl": 17,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 18,
                        "ttl": 18,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 19,
                        "ttl": 19,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 20,
                        "ttl": 20,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 21,
                        "ttl": 21,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 22,
                        "ttl": 22,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 23,
                        "ttl": 23,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 24,
                        "ttl": 24,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 25,
                        "ttl": 25,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 26,
                        "ttl": 26,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 27,
                        "ttl": 27,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 28,
                        "ttl": 28,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 29,
                        "ttl": 29,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 2,
                        "hop": 30,
                        "ttl": 30,
                        "rtt": -1,
                        "err": "timeout"
                    }
                ],
                [
                    {
                        "pass": 3,
                        "hop": 1,
                        "ttl": 1,
                        "ip": "192.168.0.1",
                        "rtt": "1.77"
                    },
                    {
                        "pass": 3,
                        "hop": 2,
                        "ttl": 2,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 3,
                        "ttl": 3,
                        "ip": "209.148.244.45",
                        "rtt": "21.37"
                    },
                    {
                        "pass": 3,
                        "hop": 4,
                        "ttl": 4,
                        "ip": "69.63.249.229",
                        "rtt": "15.53"
                    },
                    {
                        "pass": 3,
                        "hop": 5,
                        "ttl": 5,
                        "ip": "69.196.136.132",
                        "rtt": "13.41"
                    },
                    {
                        "pass": 3,
                        "hop": 6,
                        "ttl": 6,
                        "ip": "206.108.34.207",
                        "rtt": "12.36"
                    },
                    {
                        "pass": 3,
                        "hop": 7,
                        "ttl": 7,
                        "ip": "205.211.94.134",
                        "rtt": "24.37"
                    },
                    {
                        "pass": 3,
                        "hop": 8,
                        "ttl": 8,
                        "ip": "128.100.96.9",
                        "rtt": "17.76"
                    },
                    {
                        "pass": 3,
                        "hop": 9,
                        "ttl": 9,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 10,
                        "ttl": 10,
                        "ip": "142.150.148.1",
                        "rtt": "98.54"
                    },
                    {
                        "pass": 3,
                        "hop": 11,
                        "ttl": 11,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 12,
                        "ttl": 12,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 13,
                        "ttl": 13,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 14,
                        "ttl": 14,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 15,
                        "ttl": 15,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 16,
                        "ttl": 16,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 17,
                        "ttl": 17,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 18,
                        "ttl": 18,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 19,
                        "ttl": 19,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 20,
                        "ttl": 20,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 21,
                        "ttl": 21,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 22,
                        "ttl": 22,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 23,
                        "ttl": 23,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 24,
                        "ttl": 24,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 25,
                        "ttl": 25,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 26,
                        "ttl": 26,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 27,
                        "ttl": 27,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 28,
                        "ttl": 28,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 29,
                        "ttl": 29,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 3,
                        "hop": 30,
                        "ttl": 30,
                        "rtt": -1,
                        "err": "timeout"
                    }
                ],
                [
                    {
                        "pass": 4,
                        "hop": 1,
                        "ttl": 1,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 2,
                        "ttl": 2,
                        "rtt": -1,
                        "err": "offset"
                    },
                    {
                        "pass": 4,
                        "hop": 3,
                        "ttl": 3,
                        "ip": "209.148.244.45",
                        "rtt": "936.77"
                    },
                    {
                        "pass": 4,
                        "hop": 4,
                        "ttl": 4,
                        "ip": "69.63.249.229",
                        "rtt": "483.58"
                    },
                    {
                        "pass": 4,
                        "hop": 5,
                        "ttl": 5,
                        "ip": "69.196.136.132",
                        "rtt": "296.29"
                    },
                    {
                        "pass": 4,
                        "hop": 6,
                        "ttl": 6,
                        "ip": "206.108.34.207",
                        "rtt": "731.06"
                    },
                    {
                        "pass": 4,
                        "hop": 7,
                        "ttl": 7,
                        "ip": "205.211.94.134",
                        "rtt": "321.91"
                    },
                    {
                        "pass": 4,
                        "hop": 8,
                        "ttl": 8,
                        "ip": "128.100.96.9",
                        "rtt": "142.79"
                    },
                    {
                        "pass": 4,
                        "hop": 9,
                        "ttl": 9,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 10,
                        "ttl": 10,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 11,
                        "ttl": 11,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 12,
                        "ttl": 12,
                        "rtt": -1,
                        "err": "offset"
                    },
                    {
                        "pass": 4,
                        "hop": 13,
                        "ttl": 13,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 14,
                        "ttl": 14,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 15,
                        "ttl": 15,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 16,
                        "ttl": 16,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 17,
                        "ttl": 17,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 18,
                        "ttl": 18,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 19,
                        "ttl": 19,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 20,
                        "ttl": 20,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 21,
                        "ttl": 21,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 22,
                        "ttl": 22,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 23,
                        "ttl": 23,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 24,
                        "ttl": 24,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 25,
                        "ttl": 25,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 26,
                        "ttl": 26,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 27,
                        "ttl": 27,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 28,
                        "ttl": 28,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 29,
                        "ttl": 29,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 30,
                        "ttl": 30,
                        "rtt": -1,
                        "err": "timeout"
                    }
                ]
            ]
        },
        {
            "client": "platform",
            "protocol": "icmp",
            "tr_data": " 1  192.168.0.1  1.387 ms  1.239 ms  1.224 ms  1.223 ms\n 2  * * * *\n 3  209.148.244.45  12.444 ms  13.939 ms  13.591 ms  16.267 ms\n 4  69.63.249.229  20.281 ms  11.927 ms  11.689 ms  12.958 ms\n 5  69.196.136.132  11.335 ms\n    69.196.136.68  14.386 ms  12.163 ms\n    69.196.136.36  13.296 ms\n 6  206.108.34.207  12.757 ms  12.441 ms  11.590 ms  24.257 ms\n 7  205.211.94.134  54.980 ms  20.285 ms  12.264 ms  11.924 ms\n 8  128.100.96.9  14.660 ms  12.053 ms  11.118 ms  13.162 ms\n 9  * * * *\n10  142.150.148.1  18.641 ms  11.642 ms  11.282 ms  12.034 ms\n11  142.150.149.197  15.249 ms  14.953 ms  15.313 ms  15.287 ms\n",
            "tr_invocation": "traceroute -n -q 4 -m 30 142.150.149.197"
        }
    ]
};
