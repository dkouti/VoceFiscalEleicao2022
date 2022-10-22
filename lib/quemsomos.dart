import 'package:flutter/material.dart';
import 'package:flutter_webview_pro/webview_flutter.dart';

import 'dart:io';

class QuemSomos extends StatefulWidget {
  const QuemSomos({Key? key}) : super(key: key);

  @override
  State<QuemSomos> createState() => _QuemSomos();
}

class _QuemSomos extends State<QuemSomos> {
  var loadingPercentage = 0;
  @override
  Widget build(BuildContext context) {
    return Stack(
      children: [
        WebView(initialUrl: 'https://vocefiscal.com.br/vcfiscal/quemsomos.php',
          javascriptMode: JavascriptMode.unrestricted, // Add this line
        ),
        if (loadingPercentage < 100)
          LinearProgressIndicator(
            value: loadingPercentage / 100.0,
          ),
      ],
    );
  }
}
