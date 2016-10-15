
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
  "timeout": 750,
  "queries": 4,
  "dest": "www.iitb.ac.in",
  "dest_ip": "103.21.127.114",
  "submitter": "lodeanto.clintons",
  "postal_code": "M5G",
  "maxhops": 24,
  "os": "Darwin",
  "traceroute_submissions": [
    {
      "client": "IXmapsClient prerelease",
      "protocol": "ICMP",
      "tr_data": [
        [
          {
            "pass": 1,
            "hop": 1,
            "ttl": 1,
            "ip": "192.168.0.1",
            "rtt": "4.17"
          },
          {
            "pass": 1,
            "hop": 2,
            "ttl": 2,
            "ip": "173.35.58.1",
            "rtt": "23.73"
          },
          {
            "pass": 1,
            "hop": 3,
            "ttl": 3,
            "ip": "69.63.242.57",
            "rtt": "17.25"
          },
          {
            "pass": 1,
            "hop": 4,
            "ttl": 4,
            "ip": "69.63.249.237",
            "rtt": "31.52"
          },
          {
            "pass": 1,
            "hop": 5,
            "ttl": 5,
            "ip": "69.63.249.229",
            "rtt": "23.89"
          },
          {
            "pass": 1,
            "hop": 6,
            "ttl": 6,
            "ip": "69.63.249.26",
            "rtt": "32.85"
          },
          {
            "pass": 1,
            "hop": 7,
            "ttl": 7,
            "ip": "195.2.17.65",
            "rtt": "34.42"
          },
          {
            "pass": 1,
            "hop": 8,
            "ttl": 8,
            "ip": "195.2.25.146",
            "rtt": "120.28"
          },
          {
            "pass": 1,
            "hop": 9,
            "ttl": 9,
            "ip": "195.2.10.126",
            "rtt": "117.65"
          },
          {
            "pass": 1,
            "hop": 10,
            "ttl": 10,
            "ip": "213.185.219.54",
            "rtt": "214.04"
          },
          {
            "pass": 1,
            "hop": 11,
            "ttl": 11,
            "ip": "182.19.105.75",
            "rtt": "207.87"
          },
          {
            "pass": 1,
            "hop": 12,
            "ttl": 12,
            "ip": "182.19.88.145",
            "rtt": "212.54"
          },
          {
            "pass": 1,
            "hop": 13,
            "ttl": 13,
            "ip": "103.21.124.253",
            "rtt": "219.78"
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
          }
        ],
        [
          {
            "pass": 2,
            "hop": 1,
            "ttl": 1,
            "ip": "192.168.0.1",
            "rtt": "3.83"
          },
          {
            "pass": 2,
            "hop": 2,
            "ttl": 2,
            "ip": "173.35.58.1",
            "rtt": "24.92"
          },
          {
            "pass": 2,
            "hop": 3,
            "ttl": 3,
            "ip": "69.63.242.57",
            "rtt": "11.92"
          },
          {
            "pass": 2,
            "hop": 4,
            "ttl": 4,
            "ip": "69.63.249.237",
            "rtt": "16.04"
          },
          {
            "pass": 2,
            "hop": 5,
            "ttl": 5,
            "ip": "69.63.249.229",
            "rtt": "14.35"
          },
          {
            "pass": 2,
            "hop": 6,
            "ttl": 6,
            "ip": "69.63.249.26",
            "rtt": "29.44"
          },
          {
            "pass": 2,
            "hop": 7,
            "ttl": 7,
            "ip": "195.2.17.65",
            "rtt": "27.20"
          },
          {
            "pass": 2,
            "hop": 8,
            "ttl": 8,
            "ip": "195.2.25.146",
            "rtt": "103.46"
          },
          {
            "pass": 2,
            "hop": 9,
            "ttl": 9,
            "ip": "195.2.10.126",
            "rtt": "119.58"
          },
          {
            "pass": 2,
            "hop": 10,
            "ttl": 10,
            "ip": "213.185.219.54",
            "rtt": "257.51"
          },
          {
            "pass": 2,
            "hop": 11,
            "ttl": 11,
            "ip": "182.19.105.75",
            "rtt": "409.87"
          },
          {
            "pass": 2,
            "hop": 12,
            "ttl": 12,
            "ip": "182.19.88.145",
            "rtt": "213.05"
          },
          {
            "pass": 2,
            "hop": 13,
            "ttl": 13,
            "ip": "103.21.124.253",
            "rtt": "212.34"
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
          }
        ],
        [
          {
            "pass": 3,
            "hop": 1,
            "ttl": 1,
            "ip": "192.168.0.1",
            "rtt": "6.15"
          },
          {
            "pass": 3,
            "hop": 2,
            "ttl": 2,
            "ip": "173.35.58.1",
            "rtt": "22.27"
          },
          {
            "pass": 3,
            "hop": 3,
            "ttl": 3,
            "ip": "69.63.242.57",
            "rtt": "15.78"
          },
          {
            "pass": 3,
            "hop": 4,
            "ttl": 4,
            "ip": "69.63.249.237",
            "rtt": "18.41"
          },
          {
            "pass": 3,
            "hop": 5,
            "ttl": 5,
            "ip": "69.63.249.229",
            "rtt": "13.14"
          },
          {
            "pass": 3,
            "hop": 6,
            "ttl": 6,
            "ip": "69.63.249.26",
            "rtt": "31.06"
          },
          {
            "pass": 3,
            "hop": 7,
            "ttl": 7,
            "ip": "195.2.17.65",
            "rtt": "32.17"
          },
          {
            "pass": 3,
            "hop": 8,
            "ttl": 8,
            "ip": "195.2.25.146",
            "rtt": "101.09"
          },
          {
            "pass": 3,
            "hop": 9,
            "ttl": 9,
            "ip": "195.2.10.126",
            "rtt": "113.31"
          },
          {
            "pass": 3,
            "hop": 10,
            "ttl": 10,
            "ip": "213.185.219.54",
            "rtt": "290.22"
          },
          {
            "pass": 3,
            "hop": 11,
            "ttl": 11,
            "ip": "182.19.105.75",
            "rtt": "409.06"
          },
          {
            "pass": 3,
            "hop": 12,
            "ttl": 12,
            "ip": "182.19.88.145",
            "rtt": "409.62"
          },
          {
            "pass": 3,
            "hop": 13,
            "ttl": 13,
            "ip": "103.21.124.253",
            "rtt": "408.96"
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
          }
        ],
        [
          {
            "pass": 4,
            "hop": 1,
            "ttl": 1,
            "ip": "192.168.0.1",
            "rtt": "5.63"
          },
          {
            "pass": 4,
            "hop": 2,
            "ttl": 2,
            "ip": "173.35.58.1",
            "rtt": "13.25"
          },
          {
            "pass": 4,
            "hop": 3,
            "ttl": 3,
            "ip": "69.63.242.57",
            "rtt": "16.21"
          },
          {
            "pass": 4,
            "hop": 4,
            "ttl": 4,
            "ip": "69.63.249.237",
            "rtt": "16.65"
          },
          {
            "pass": 4,
            "hop": 5,
            "ttl": 5,
            "ip": "69.63.249.229",
            "rtt": "17.46"
          },
          {
            "pass": 4,
            "hop": 6,
            "ttl": 6,
            "ip": "69.63.249.26",
            "rtt": "36.68"
          },
          {
            "pass": 4,
            "hop": 7,
            "ttl": 7,
            "ip": "195.2.17.65",
            "rtt": "36.52"
          },
          {
            "pass": 4,
            "hop": 8,
            "ttl": 8,
            "ip": "195.2.25.146",
            "rtt": "106.17"
          },
          {
            "pass": 4,
            "hop": 9,
            "ttl": 9,
            "ip": "195.2.10.126",
            "rtt": "120.69"
          },
          {
            "pass": 4,
            "hop": 10,
            "ttl": 10,
            "ip": "213.185.219.54",
            "rtt": "297.84"
          },
          {
            "pass": 4,
            "hop": 11,
            "ttl": 11,
            "ip": "182.19.105.75",
            "rtt": "408.61"
          },
          {
            "pass": 4,
            "hop": 12,
            "ttl": 12,
            "ip": "182.19.88.145",
            "rtt": "409.07"
          },
          {
            "pass": 4,
            "hop": 13,
            "ttl": 13,
            "ip": "103.21.124.253",
            "rtt": "319.56"
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
          }
        ]
      ]
    }
  ]
};
var TrTestJsonData1={
    "timeout": "1000",
    "queries": "4",
    "dest": "www.unal.edu.co",
    "dest_ip": "168.176.5.69",
    "submitter": "lodeanto.ixnode.m",
    "postal_code": "m6g",
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
                        "rtt": "2.73"
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
                        "ip": "209.148.244.49",
                        "rtt": "13.81"
                    },
                    {
                        "pass": 1,
                        "hop": 4,
                        "ttl": 4,
                        "ip": "69.63.252.250",
                        "rtt": "13.35"
                    },
                    {
                        "pass": 1,
                        "hop": 5,
                        "ttl": 5,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 1,
                        "hop": 6,
                        "ttl": 6,
                        "ip": "157.238.64.233",
                        "rtt": "29.22"
                    },
                    {
                        "pass": 1,
                        "hop": 7,
                        "ttl": 7,
                        "ip": "144.232.0.197",
                        "rtt": "65.34"
                    },
                    {
                        "pass": 1,
                        "hop": 8,
                        "ttl": 8,
                        "ip": "144.232.1.105",
                        "rtt": "25.83"
                    },
                    {
                        "pass": 1,
                        "hop": 9,
                        "ttl": 9,
                        "ip": "144.232.19.119",
                        "rtt": "30.06"
                    },
                    {
                        "pass": 1,
                        "hop": 10,
                        "ttl": 10,
                        "ip": "144.232.6.114",
                        "rtt": "53.38"
                    },
                    {
                        "pass": 1,
                        "hop": 11,
                        "ttl": 11,
                        "ip": "144.232.5.214",
                        "rtt": "52.82"
                    },
                    {
                        "pass": 1,
                        "hop": 12,
                        "ttl": 12,
                        "ip": "144.232.6.15",
                        "rtt": "66.22"
                    },
                    {
                        "pass": 1,
                        "hop": 13,
                        "ttl": 13,
                        "ip": "144.232.6.18",
                        "rtt": "68.38"
                    },
                    {
                        "pass": 1,
                        "hop": 14,
                        "ttl": 14,
                        "ip": "160.81.164.134",
                        "rtt": "115.78"
                    },
                    {
                        "pass": 1,
                        "hop": 15,
                        "ttl": 15,
                        "ip": "200.30.65.234",
                        "rtt": "113.98"
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
                        "rtt": "3.93"
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
                        "ip": "209.148.244.49",
                        "rtt": "16.99"
                    },
                    {
                        "pass": 2,
                        "hop": 4,
                        "ttl": 4,
                        "ip": "69.63.252.250",
                        "rtt": "16.16"
                    },
                    {
                        "pass": 2,
                        "hop": 5,
                        "ttl": 5,
                        "ip": "24.156.144.178",
                        "rtt": "22.66"
                    },
                    {
                        "pass": 2,
                        "hop": 6,
                        "ttl": 6,
                        "ip": "157.238.64.233",
                        "rtt": "26.04"
                    },
                    {
                        "pass": 2,
                        "hop": 7,
                        "ttl": 7,
                        "ip": "144.232.0.197",
                        "rtt": "30.18"
                    },
                    {
                        "pass": 2,
                        "hop": 8,
                        "ttl": 8,
                        "ip": "144.232.1.105",
                        "rtt": "27.99"
                    },
                    {
                        "pass": 2,
                        "hop": 9,
                        "ttl": 9,
                        "ip": "144.232.19.119",
                        "rtt": "31.68"
                    },
                    {
                        "pass": 2,
                        "hop": 10,
                        "ttl": 10,
                        "ip": "144.232.6.114",
                        "rtt": "40.28"
                    },
                    {
                        "pass": 2,
                        "hop": 11,
                        "ttl": 11,
                        "ip": "144.232.5.214",
                        "rtt": "52.26"
                    },
                    {
                        "pass": 2,
                        "hop": 12,
                        "ttl": 12,
                        "ip": "144.232.6.15",
                        "rtt": "69.98"
                    },
                    {
                        "pass": 2,
                        "hop": 13,
                        "ttl": 13,
                        "ip": "144.232.6.18",
                        "rtt": "67.86"
                    },
                    {
                        "pass": 2,
                        "hop": 14,
                        "ttl": 14,
                        "ip": "160.81.164.134",
                        "rtt": "127.46"
                    },
                    {
                        "pass": 2,
                        "hop": 15,
                        "ttl": 15,
                        "ip": "200.30.65.234",
                        "rtt": "131.71"
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
                        "rtt": "8.09"
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
                        "ip": "209.148.244.49",
                        "rtt": "17.50"
                    },
                    {
                        "pass": 3,
                        "hop": 4,
                        "ttl": 4,
                        "ip": "69.63.252.250",
                        "rtt": "15.49"
                    },
                    {
                        "pass": 3,
                        "hop": 5,
                        "ttl": 5,
                        "ip": "24.156.144.178",
                        "rtt": "27.26"
                    },
                    {
                        "pass": 3,
                        "hop": 6,
                        "ttl": 6,
                        "ip": "157.238.64.233",
                        "rtt": "26.23"
                    },
                    {
                        "pass": 3,
                        "hop": 7,
                        "ttl": 7,
                        "ip": "144.232.0.197",
                        "rtt": "24.01"
                    },
                    {
                        "pass": 3,
                        "hop": 8,
                        "ttl": 8,
                        "ip": "144.232.1.105",
                        "rtt": "46.39"
                    },
                    {
                        "pass": 3,
                        "hop": 9,
                        "ttl": 9,
                        "ip": "144.232.19.119",
                        "rtt": "37.05"
                    },
                    {
                        "pass": 3,
                        "hop": 10,
                        "ttl": 10,
                        "ip": "144.232.6.114",
                        "rtt": "37.29"
                    },
                    {
                        "pass": 3,
                        "hop": 11,
                        "ttl": 11,
                        "ip": "144.232.5.214",
                        "rtt": "51.32"
                    },
                    {
                        "pass": 3,
                        "hop": 12,
                        "ttl": 12,
                        "ip": "144.232.6.15",
                        "rtt": "64.67"
                    },
                    {
                        "pass": 3,
                        "hop": 13,
                        "ttl": 13,
                        "ip": "144.232.6.18",
                        "rtt": "67.93"
                    },
                    {
                        "pass": 3,
                        "hop": 14,
                        "ttl": 14,
                        "ip": "160.81.164.134",
                        "rtt": "197.88"
                    },
                    {
                        "pass": 3,
                        "hop": 15,
                        "ttl": 15,
                        "ip": "200.30.65.234",
                        "rtt": "116.12"
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
                        "ip": "192.168.0.1",
                        "rtt": "5.64"
                    },
                    {
                        "pass": 4,
                        "hop": 2,
                        "ttl": 2,
                        "rtt": -1,
                        "err": "timeout"
                    },
                    {
                        "pass": 4,
                        "hop": 3,
                        "ttl": 3,
                        "ip": "209.148.244.49",
                        "rtt": "15.19"
                    },
                    {
                        "pass": 4,
                        "hop": 4,
                        "ttl": 4,
                        "ip": "69.63.252.250",
                        "rtt": "13.53"
                    },
                    {
                        "pass": 4,
                        "hop": 5,
                        "ttl": 5,
                        "ip": "24.156.144.178",
                        "rtt": "20.82"
                    },
                    {
                        "pass": 4,
                        "hop": 6,
                        "ttl": 6,
                        "ip": "157.238.64.233",
                        "rtt": "30.16"
                    },
                    {
                        "pass": 4,
                        "hop": 7,
                        "ttl": 7,
                        "ip": "144.232.0.197",
                        "rtt": "29.68"
                    },
                    {
                        "pass": 4,
                        "hop": 8,
                        "ttl": 8,
                        "ip": "144.232.1.105",
                        "rtt": "27.47"
                    },
                    {
                        "pass": 4,
                        "hop": 9,
                        "ttl": 9,
                        "ip": "144.232.19.119",
                        "rtt": "32.64"
                    },
                    {
                        "pass": 4,
                        "hop": 10,
                        "ttl": 10,
                        "ip": "144.232.6.114",
                        "rtt": "34.80"
                    },
                    {
                        "pass": 4,
                        "hop": 11,
                        "ttl": 11,
                        "ip": "144.232.5.214",
                        "rtt": "84.58"
                    },
                    {
                        "pass": 4,
                        "hop": 12,
                        "ttl": 12,
                        "ip": "144.232.6.15",
                        "rtt": "70.12"
                    },
                    {
                        "pass": 4,
                        "hop": 13,
                        "ttl": 13,
                        "ip": "144.232.6.18",
                        "rtt": "65.04"
                    },
                    {
                        "pass": 4,
                        "hop": 14,
                        "ttl": 14,
                        "ip": "160.81.164.134",
                        "rtt": "116.20"
                    },
                    {
                        "pass": 4,
                        "hop": 15,
                        "ttl": 15,
                        "ip": "200.30.65.234",
                        "rtt": "121.17"
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
            "tr_data": " 1  192.168.0.1  3.866 ms  1.152 ms  1.024 ms  7.601 ms\n 2  * * * *\n 3  209.148.244.49  16.390 ms  10.778 ms  20.582 ms  11.411 ms\n 4  69.63.252.250  8.932 ms  14.715 ms  9.220 ms  20.035 ms\n 5  * 24.156.144.178  24.093 ms  25.566 ms  22.268 ms\n 6  157.238.64.233  23.512 ms  28.766 ms  23.105 ms  23.502 ms\n 7  144.232.0.197  24.825 ms  27.281 ms  23.750 ms  24.366 ms\n 8  144.232.7.253  27.434 ms\n    144.232.1.105  35.395 ms\n    144.232.7.253  31.119 ms  24.403 ms\n 9  144.232.24.47  38.026 ms  30.532 ms  27.386 ms  31.360 ms\n10  144.232.6.108  44.608 ms\n    144.232.6.114  36.841 ms  39.276 ms  33.109 ms\n11  144.232.5.214  54.413 ms\n    144.232.5.212  53.490 ms  53.234 ms  54.655 ms\n12  144.232.6.15  69.722 ms\n    144.232.6.13  66.280 ms\n    144.232.6.15  66.962 ms  69.880 ms\n13  144.232.6.16  66.552 ms  74.049 ms\n    144.232.6.18  75.659 ms  67.313 ms\n14  160.81.164.134  110.549 ms  118.075 ms  115.601 ms  112.876 ms\n15  200.30.65.234  115.956 ms  123.925 ms  113.465 ms  119.293 ms\n16  * * * *\n17  * * * *\n18  * * * *\n19  * * * *\n20  * *",
            "tr_invocation": "traceroute -n -q 4 -m 30 168.176.5.69"
        }
    ],
    "error": "{\"aborted\":true}"
};
