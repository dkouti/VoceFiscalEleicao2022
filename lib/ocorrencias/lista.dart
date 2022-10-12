import 'package:flutter/material.dart';
import 'package:flutter_webview_pro/webview_flutter.dart';

import 'dart:io';

class ListaOcorrencias extends StatefulWidget {
  const ListaOcorrencias({Key? key}) : super(key: key);

  @override
  State<ListaOcorrencias> createState() => _ListaOcorrencias();
}

class _ListaOcorrencias extends State<ListaOcorrencias> {
  var loadingPercentage = 0;
  @override
  Widget build(BuildContext context) {
    return Stack(
      children: [
        WebView(initialUrl: 'https://vocefiscal.com.br/v2/paginacao/',
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
