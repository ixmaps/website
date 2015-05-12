
var submitTr = function (){
  console.log('submitTr...');
  //var testData = jQuery.parseJSON(testJson);
  //console.log(testJson);

}

var collectTrData = function(){
  //testJson1.traceroute_submissions[0].tr_data=jQuery('#raw1').val();
  //testJson1.traceroute_submissions[1].tr_data=jQuery('#raw1').val();
  //testJson1.traceroute_submissions[2].tr_data=jQuery('#raw2').val();
  //testJson1.traceroute_submissions[3].tr_data=jQuery('#raw4').val();  
  //console.log(testJson1);

  ajaxObj = jQuery.ajax(url_base + '/application/controller/gather_tr.php', {
    type: 'post',
    data: testJson1,
    success: function (e) {
      console.log("collectTrData: OK! ", e);
      //if(e!=0){
      //var data = jQuery.parseJSON(e);
      //jQuery('#filter-results-log').html(data.queryLogs);
      
    },
    error: function (e) {
      console.log("collectTrData: Error! : Submission unsuccessful");
      
    }
  });

}

var testJson1={
    "timeout": "1",
    "queries": "4",
    "dest": "zooid.org",
    "dest_ip": "142.4.222.224",
    "submitter": "me",
    "postal_code": "M6G 1L5",
    "maxhops": "255",
    "os": "Linux",
    "traceroute_submissions": [
        {
            "client": "ixjs v.0.0.1",
            "protocol": "icmp",
            "tr_data": [
                [
                    {
                        "pass": "1",
                        "hop": "1",
                        "ttl": "1",
                        "ip": "199.166.207.4",
                        "rtt": "2.68"
                    },
                    {
                        "pass": "2",
                        "hop": "1",
                        "ttl": "1",
                        "ip": "199.166.207.1",
                        "rtt": "0.42"
                    },
                    {
                        "pass": "3",
                        "hop": "1",
                        "ttl": "1",
                        "ip": "199.166.207.2",
                        "rtt": "0.48"
                    },
                    {
                        "pass": "4",
                        "hop": "1",
                        "ttl": "1",
                        "ip": "199.166.207.1",
                        "rtt": "0.50"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "2",
                        "ttl": "2",
                        "ip": "216.235.0.1",
                        "rtt": "13.10"
                    },
                    {
                        "pass": "2",
                        "hop": "2",
                        "ttl": "2",
                        "ip": "216.235.0.2",
                        "rtt": "12.35"
                    },
                    {
                        "pass": "3",
                        "hop": "2",
                        "ttl": "2",
                        "ip": "216.235.0.3",
                        "rtt": "12.40"
                    },
                    {
                        "pass": "4",
                        "hop": "2",
                        "ttl": "2",
                        "ip": "216.235.0.3",
                        "rtt": "10.10"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "3",
                        "ttl": "3",
                        "ip": "216.235.0.165",
                        "rtt": "16.72"
                    },
                    {
                        "pass": "2",
                        "hop": "3",
                        "ttl": "3",
                        "ip": "216.235.0.165",
                        "rtt": "15.54"
                    },
                    {
                        "pass": "3",
                        "hop": "3",
                        "ttl": "3",
                        "ip": "216.235.0.165",
                        "rtt": "15.94"
                    },
                    {
                        "pass": "4",
                        "hop": "3",
                        "ttl": "3",
                        "ip": "216.235.0.165",
                        "rtt": "28.88"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "4",
                        "ttl": "4",
                        "rtt": "-1",
                        "err": "timeout"
                    },
                    {
                        "pass": "2",
                        "hop": "4",
                        "ttl": "4",
                        "rtt": "-1",
                        "err": "timeout"
                    },
                    {
                        "pass": "3",
                        "hop": "4",
                        "ttl": "4",
                        "rtt": "-1",
                        "err": "timeout"
                    },
                    {
                        "pass": "4",
                        "hop": "4",
                        "ttl": "4",
                        "rtt": "-1",
                        "err": "timeout"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "5",
                        "ttl": "5",
                        "ip": "178.32.135.71",
                        "rtt": "20.89"
                    },
                    {
                        "pass": "2",
                        "hop": "5",
                        "ttl": "5",
                        "ip": "178.32.135.71",
                        "rtt": "20.72"
                    },
                    {
                        "pass": "3",
                        "hop": "5",
                        "ttl": "5",
                        "ip": "178.32.135.71",
                        "rtt": "20.76"
                    },
                    {
                        "pass": "4",
                        "hop": "5",
                        "ttl": "5",
                        "ip": "178.32.135.71",
                        "rtt": "20.81"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "6",
                        "ttl": "6",
                        "ip": "198.27.73.7",
                        "rtt": "269.93"
                    },
                    {
                        "pass": "2",
                        "hop": "6",
                        "ttl": "6",
                        "ip": "198.27.73.7",
                        "rtt": "112.78"
                    },
                    {
                        "pass": "3",
                        "hop": "6",
                        "ttl": "6",
                        "ip": "198.27.73.7",
                        "rtt": "29.67"
                    },
                    {
                        "pass": "4",
                        "hop": "6",
                        "ttl": "6",
                        "ip": "198.27.73.7",
                        "rtt": "66.00"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "7",
                        "ttl": "7",
                        "ip": "198.27.73.94",
                        "rtt": "23.10"
                    },
                    {
                        "pass": "2",
                        "hop": "7",
                        "ttl": "7",
                        "ip": "198.27.73.94",
                        "rtt": "21.90"
                    },
                    {
                        "pass": "3",
                        "hop": "7",
                        "ttl": "7",
                        "ip": "198.27.73.94",
                        "rtt": "22.19"
                    },
                    {
                        "pass": "4",
                        "hop": "7",
                        "ttl": "7",
                        "ip": "198.27.73.94",
                        "rtt": "23.71"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "8",
                        "ttl": "8",
                        "ip": "192.99.34.62",
                        "rtt": "20.82"
                    },
                    {
                        "pass": "2",
                        "hop": "8",
                        "ttl": "8",
                        "ip": "192.99.34.62",
                        "rtt": "21.02"
                    },
                    {
                        "pass": "3",
                        "hop": "8",
                        "ttl": "8",
                        "ip": "192.99.34.62",
                        "rtt": "20.90"
                    },
                    {
                        "pass": "4",
                        "hop": "8",
                        "ttl": "8",
                        "ip": "192.99.34.62",
                        "rtt": "21.04"
                    }
                ],
                [
                    {
                        "pass": "1",
                        "hop": "9",
                        "ttl": "9",
                        "ip": "142.4.222.1",
                        "rtt": "10.10"
                    },
                    {
                        "pass": "2",
                        "hop": "9",
                        "ttl": "9",
                        "ip": "142.4.222.2",
                        "rtt": "21.48"
                    },
                    {
                        "pass": "3",
                        "hop": "9",
                        "ttl": "9",
                        "ip": "142.4.222.224",
                        "rtt": "22.16"
                    },
                    {
                        "pass": "4",
                        "hop": "9",
                        "ttl": "9",
                        "ip": "142.4.222.2",
                        "rtt": "21.47"
                    }
                ]
            ]
        },
        {
            "client": "traceroute",
            "protocol": "icmp",
            "tr_data": "traceroute -n -q 4 -P icmp  www.ixmaps.ca\ntraceroute to www.ixmaps.ca (142.150.149.197), 64 hops max, 72 byte packets\n 1  192.168.0.1  1.602 ms  1.127 ms  5.179 ms  1.112 ms\n 2  181.49.53.77  2.245 ms  1.789 ms  1.968 ms  1.908 ms\n 3  10.177.48.1  3.649 ms  3.453 ms  2.685 ms  3.073 ms\n 4  200.26.135.102  3.879 ms  3.581 ms  3.821 ms  4.007 ms\n 5  200.26.135.101  5.990 ms  12.909 ms  7.208 ms  7.887 ms\n 6  * * * *\n 7  160.81.138.1  58.225 ms  58.180 ms  58.197 ms  58.344 ms\n 8  144.232.15.40  61.902 ms  63.381 ms  59.765 ms  58.910 ms\n 9  144.232.25.70  57.965 ms  59.929 ms  58.005 ms  58.081 ms\n10  154.54.24.233  59.106 ms  59.021 ms  59.278 ms  58.828 ms\n11  154.54.24.197  87.142 ms  87.098 ms  86.730 ms  87.302 ms\n12  154.54.28.73  107.072 ms  104.889 ms  106.494 ms  104.811 ms\n13  154.54.43.178  100.962 ms  100.969 ms  102.190 ms  102.257 ms\n14  154.54.31.90  102.196 ms  101.987 ms  103.243 ms  100.629 ms\n15  154.54.0.122  99.305 ms  100.723 ms  99.190 ms  99.008 ms\n16  38.117.74.226  101.817 ms  102.000 ms  101.176 ms  101.824 ms\n17  128.100.96.9  102.807 ms  101.445 ms  101.139 ms  100.996 ms\n18  * * * *\n19  142.150.148.1  88.371 ms  87.781 ms  87.605 ms  87.533 ms\n20  142.150.149.197  88.166 ms  88.027 ms  87.921 ms  87.073 ms"
        },
        {
            "client": "traceroute",
            "protocol": "udp",
            "tr_data": "traceroute -n -q 4 -P udp  www.ixmaps.ca\ntraceroute to www.ixmaps.ca (142.150.149.197), 64 hops max, 52 byte packets\n 1  192.168.0.1  1.652 ms  1.228 ms  1.169 ms  1.075 ms\n 2  181.48.239.233  2.839 ms\n    181.49.53.77  2.174 ms\n    181.48.239.233  2.810 ms\n    181.49.53.77  2.043 ms\n 3  10.177.48.1  2.217 ms  2.509 ms  2.337 ms  2.620 ms\n 4  200.26.135.102  3.901 ms  4.183 ms  3.151 ms *\n 5  200.26.135.101  7.252 ms\n    190.81.241.161  3.949 ms\n    200.26.135.101  3.947 ms\n    190.81.241.161  3.709 ms\n 6  * * * *\n 7  160.81.138.1  58.859 ms  57.839 ms  58.305 ms  61.141 ms\n 8  144.232.2.235  61.761 ms\n    144.232.12.73  58.300 ms\n    144.232.12.75  59.882 ms\n    144.232.2.233  62.003 ms\n 9  144.232.24.214  59.742 ms\n    144.232.7.90  43.678 ms\n    144.232.24.214  62.163 ms\n    144.232.7.90  44.114 ms\n10  154.54.24.233  59.762 ms\n    154.54.80.41  44.282 ms\n    154.54.24.233  59.252 ms\n    154.54.80.41  44.225 ms\n11  154.54.24.193  87.217 ms  57.103 ms  87.806 ms\n    154.54.24.197  57.355 ms\n12  154.54.28.73  105.442 ms  87.522 ms\n    154.54.29.97  87.183 ms\n    154.54.28.73  87.966 ms\n13  154.54.43.178  100.944 ms\n    154.54.44.86  88.116 ms\n    154.54.43.178  103.073 ms\n    154.54.44.86  87.444 ms\n14  154.54.31.54  99.449 ms  87.956 ms  99.493 ms\n    154.54.31.90  93.794 ms\n15  154.54.0.122  99.259 ms  87.301 ms  99.735 ms\n    66.28.4.166  87.508 ms\n16  38.117.74.226  101.724 ms  87.601 ms  102.855 ms  87.157 ms\n17  128.100.96.9  102.980 ms  87.819 ms  102.606 ms  87.324 ms\n18  * * * *\n19  142.150.148.1  87.884 ms  102.631 ms  88.238 ms  102.205 ms\n20  142.150.149.197  87.404 ms  102.917 ms  87.088 ms  102.513 ms"
        }
    ]
};


var testJson={
  dest: 'www.ixmaps.ca',
  dest_ip:'142.150.149.197',
  submitter: 'anto',
  os:'macos, v.10.6',
  postal_code: 'M6G',
  timeout: 1,
  queries: 4,
  maxhops: 64,
  traceroute_submissions: [
    {
      client:'ixnodejs v.1',
      protocol:'icmp',
      format: 'json',
      tr_data:'some data1'
    },
    {
      client:'ixnodejs v.1',
      protocol:'udp',
      format: 'txt',
      tr_data:'some data2'
    },
    {
      client:'traceroute',
      protocol:'udp',
      format: 'txt',
      tr_data:'some data3'
    },
    {
      client:'traceroute',
      protocol:'icmp',
      format: 'txt',
      tr_data:'some data4'
    }
  ]
};