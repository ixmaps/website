var submitTrData = function(){

    ajaxObj = jQuery.ajax({
      url: url_base + '/application/controller/gather_tr.php',
      type:"POST",
      data:TrTestJsonData,
      //contentType:"application/json; charset=utf-8",
      //dataType:"json",
    success: function (e) {
      console.log("submitTrData: OK! ", e);
    },
    error: function (e) {
      console.log("submitTrData: Error!"); 
    }
    });
}

var submitPost = function(){
    jQuery.post( url_base + '/application/controller/gather.php', TrTestJsonData, function submitPostSuccess(e){
        console.log("OK: submitPostSuccess", e);
    });
}

var TrTestJsonData={
    "timeout": "1",
    "queries": "4",
    "dest": "www.ixmaps.ca",
    "dest_ip": "142.150.149.197",
    "submitter": "lodeanto.ixnode.sample",
    "postal_code": "M6G 1L5",
    "maxhops": "255",
    "os": "Mac OS",
    "traceroute_submissions": [
        {
            "client": "ixnode ver .1.0",
            "protocol": "icmp",
            "tr_data": [
                [
                    {
                        "pass": "1",
                        "hop": "1",
                        "ttl": "1",
                        "ip": "192.168.0.1",
                        "rtt": "73.30"
                    },
                    {
                        "pass": "2",
                        "hop": "1",
                        "ttl": "1",
                        "ip": "192.168.0.1",
                        "rtt": "3.49"
                    },
                    {
                        "pass": "3",
                        "hop": "1",
                        "ttl": "1",
                        "ip": "192.168.0.1",
                        "rtt": "1.14"
                    },
                    {
                        "pass": "4",
                        "hop": "1",
                        "ttl": "1",
                        "ip": "192.168.0.1",
                        "rtt": "4.20"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "2",
                        "ttl": "2",
                        "rtt": "-1",
                        "err": "timeout"
                    },
                    {
                        "pass": "2",
                        "hop": "2",
                        "ttl": "2",
                        "rtt": "-1",
                        "err": "timeout"
                    },
                    {
                        "pass": "3",
                        "hop": "2",
                        "ttl": "2",
                        "rtt": "-1",
                        "err": "timeout"
                    },
                    {
                        "pass": "4",
                        "hop": "2",
                        "ttl": "2",
                        "rtt": "-1",
                        "err": "timeout"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "3",
                        "ttl": "3",
                        "ip": "209.148.244.45",
                        "rtt": "17.51"
                    },
                    {
                        "pass": "2",
                        "hop": "3",
                        "ttl": "3",
                        "ip": "209.148.244.45",
                        "rtt": "12.78"
                    },
                    {
                        "pass": "3",
                        "hop": "3",
                        "ttl": "3",
                        "ip": "209.148.244.45",
                        "rtt": "10.93"
                    },
                    {
                        "pass": "4",
                        "hop": "3",
                        "ttl": "3",
                        "ip": "209.148.244.45",
                        "rtt": "16.09"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "4",
                        "ttl": "4",
                        "ip": "69.63.249.229",
                        "rtt": "11.98",
                    },
                    {
                        "pass": "2",
                        "hop": "4",
                        "ttl": "4",
                        "ip": "69.63.249.229",
                        "rtt": "12.78",
                    },
                    {
                        "pass": "3",
                        "hop": "4",
                        "ttl": "4",
                        "ip": "69.63.249.229",
                        "rtt": "11.23",
                    },
                    {
                        "pass": "4",
                        "hop": "4",
                        "ttl": "4",
                        "ip": "69.63.249.229",
                        "rtt": "11.61",
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "5",
                        "ttl": "5",
                        "ip": "69.196.136.132",
                        "rtt": "11.08"
                    },
                    {
                        "pass": "2",
                        "hop": "5",
                        "ttl": "5",
                        "ip": "69.196.136.132",
                        "rtt": "19.87"
                    },
                    {
                        "pass": "3",
                        "hop": "5",
                        "ttl": "5",
                        "ip": "69.196.136.132",
                        "rtt": "10.75"
                    },
                    {
                        "pass": "4",
                        "hop": "5",
                        "ttl": "5",
                        "ip": "69.196.136.132",
                        "rtt": "10.68"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "6",
                        "ttl": "6",
                        "ip": "206.108.34.207",
                        "rtt": "16.81"
                    },
                    {
                        "pass": "2",
                        "hop": "6",
                        "ttl": "6",
                        "ip": "206.108.34.207",
                        "rtt": "27.78"
                    },
                    {
                        "pass": "3",
                        "hop": "6",
                        "ttl": "6",
                        "ip": "206.108.34.207",
                        "rtt": "12.42"
                    },
                    {
                        "pass": "4",
                        "hop": "6",
                        "ttl": "6",
                        "ip": "206.108.34.207",
                        "rtt": "12.16"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "7",
                        "ttl": "7",
                        "ip": "205.211.94.134",
                        "rtt": "11.65"
                    },
                    {
                        "pass": "2",
                        "hop": "7",
                        "ttl": "7",
                        "ip": "205.211.94.134",
                        "rtt": "13.12"
                    },
                    {
                        "pass": "3",
                        "hop": "7",
                        "ttl": "7",
                        "ip": "205.211.94.134",
                        "rtt": "10.70"
                    },
                    {
                        "pass": "4",
                        "hop": "7",
                        "ttl": "7",
                        "ip": "205.211.94.134",
                        "rtt": "13.50"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "8",
                        "ttl": "8",
                        "ip": "128.100.96.9",
                        "rtt": "12.92"
                    },
                    {
                        "pass": "2",
                        "hop": "8",
                        "ttl": "8",
                        "ip": "128.100.96.9",
                        "rtt": "15.97"
                    },
                    {
                        "pass": "3",
                        "hop": "8",
                        "ttl": "8",
                        "ip": "128.100.96.9",
                        "rtt": "12.52"
                    },
                    {
                        "pass": "4",
                        "hop": "8",
                        "ttl": "8",
                        "ip": "128.100.96.9",
                        "rtt": "10.78"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "9",
                        "ttl": "9",
                        "rtt": "-1",
                        "err": "timeout"
                    },
                    {
                        "pass": "2",
                        "hop": "9",
                        "ttl": "9",
                        "rtt": "-1",
                        "err": "timeout"
                    },
                    {
                        "pass": "3",
                        "hop": "9",
                        "ttl": "9",
                        "rtt": "-1",
                        "err": "timeout"
                    },
                    {
                        "pass": "4",
                        "hop": "9",
                        "ttl": "9",
                        "rtt": "-1",
                        "err": "timeout"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "10",
                        "ttl": "10",
                        "ip": "142.150.148.1",
                        "rtt": "50.88"
                    },
                    {
                        "pass": "2",
                        "hop": "10",
                        "ttl": "10",
                        "ip": "142.150.148.1",
                        "rtt": "28.99"
                    },
                    {
                        "pass": "3",
                        "hop": "10",
                        "ttl": "10",
                        "ip": "142.150.148.1",
                        "rtt": "37.13"
                    },
                    {
                        "pass": "4",
                        "hop": "10",
                        "ttl": "10",
                        "ip": "142.150.148.1",
                        "rtt": "23.88"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "11",
                        "ttl": "11",
                        "ip": "142.150.149.197",
                        "rtt": "18.43"
                    },
                    {
                        "pass": "2",
                        "hop": "11",
                        "ttl": "11",
                        "ip": "142.150.149.197",
                        "rtt": "14.35"
                    },
                    {
                        "pass": "3",
                        "hop": "11",
                        "ttl": "11",
                        "ip": "142.150.149.197",
                        "rtt": "20.18"
                    },
                    {
                        "pass": "4",
                        "hop": "11",
                        "ttl": "11",
                        "ip": "142.150.149.197",
                        "rtt": "16.36"
                    }
                ]
            ]
        },
        {
            "client": "traceroute",
            "protocol": "icmp",
            "tr_data":"traceroute -n -q 4 -P icmp www.ixmaps.catraceroute to www.ixmaps.ca (142.150.149.197), 64 hops max, 72 byte packets\n 1 192.168.0.1 73.303 ms 3.494 ms 1.141 ms 4.209 ms\n 2 * * * *\n 3 209.148.244.45 17.515 ms 12.786 ms 10.938 ms 16.091 ms\n 4 69.63.249.229 11.980 ms 12.772 ms 11.232 ms 11.613 ms\n 5 69.196.136.132 11.087 ms 19.879 ms 10.758 ms 10.689 ms\n 6 206.108.34.207 16.817 ms 27.789 ms 12.426 ms 12.167 ms\n 7 205.211.94.134 11.654 ms 13.126 ms 10.700 ms 13.506 ms\n 8 128.100.96.9 12.292 ms 15.972 ms 12.528 ms 10.784 ms\n 9 * * * *\n10 142.150.148.1 50.882 ms 28.992 ms 37.135 ms 23.888 ms\n11 142.150.149.197 18.432 ms 14.358 ms 20.187 ms 16.365 ms"
        },
        {
            "client": "traceroute",
            "protocol": "udp",
            "tr_data":"traceroute -n -q 4 -P udp www.ixmaps.ca\ntraceroute to www.ixmaps.ca (142.150.149.197), 64 hops max, 52 byte packets\n 1 192.168.0.1 27.319 ms 13.913 ms 4.373 ms 1.297 ms\n 2 * * * *\n 3 209.148.244.45 23.427 ms 16.753 ms 16.070 ms 14.636 ms\n 4 69.63.249.229 13.486 ms 9.501 ms 11.765 ms 18.257 ms\n 5 69.196.136.36 17.152 ms 12.914 ms\n 69.196.136.164 12.625 ms\n 69.196.136.36 15.198 ms\n 6 206.108.34.207 16.016 ms 11.917 ms 14.360 ms 11.098 ms\n 7 205.211.94.134 11.623 ms 11.448 ms 11.790 ms 12.636 ms\n 8 128.100.96.9 12.639 ms 11.993 ms 20.451 ms 17.629 ms\n 9 * * * *\n10 142.150.148.1 12.143 ms 12.125 ms 13.290 ms 11.937 ms\n11 142.150.149.197 12.801 ms 31.861 ms 13.223 ms 13.283 ms"
        }
    ]
};
