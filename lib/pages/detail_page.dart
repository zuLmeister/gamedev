import 'package:flutter/material.dart';
import '../components/Navbar.dart';

class DetailPage extends StatefulWidget {
  const DetailPage({Key? key}) : super(key: key);
  @override
  // ignore: library_private_types_in_public_api
  _DetailPageState createState() => _DetailPageState();
}

class _DetailPageState extends State<DetailPage> {
  var imageURL = [
    'assets/images/slider1.jpg',
    'assets/images/background.jpg',
  ];
  @override
  Widget build(BuildContext context) {
    final mediaQueryHeight = MediaQuery.of(context).size.height;
    final mediaQueryWidth = MediaQuery.of(context).size.width;
    final bool landScape =
        MediaQuery.of(context).orientation == Orientation.landscape;
    final bodyHeight = mediaQueryHeight - MediaQuery.of(context).padding.top;
    var stars = Row(
      mainAxisSize: MainAxisSize.min,
      children: [
        Icon(Icons.star, color: Colors.green[500]),
        Icon(Icons.star, color: Colors.green[500]),
        Icon(Icons.star, color: Colors.green[500]),
        const Icon(Icons.star, color: Colors.black),
        const Icon(Icons.star, color: Colors.black),
      ],
    );
    return Scaffold(
      drawer: const Navbar(),
      backgroundColor: Color.fromARGB(255, 35, 34, 34),
      appBar: AppBar(
        title: Image.asset('assets/icons/logo.png', height: 70.0),
        centerTitle: true,
        backgroundColor: Color.fromARGB(255, 35, 34, 34),
      ),
      body: Center(
        child: ListView(
          children: <Widget>[
            Container(
              alignment: Alignment.topLeft,
              padding: const EdgeInsets.all(15),
              child: const Text(
                'Left 4 Dead',
                style: TextStyle(
                    fontSize: 40,
                    // fontFamily: 'Inter',
                    fontWeight: FontWeight.w900,
                    color: Colors.white),
              ),
            ),
            Container(
              child: Row(
                textDirection: TextDirection.rtl,
                children: [
                  const Padding(padding: EdgeInsets.all(10)),
                  const Expanded(
                      child: Text(
                    "Flutter's hot reload helps you quickly and easily experiment, build UIs, add features, and fix bug faster. Experience sub-second reload times, without losing state, on emulators, simulators, and hardware for iOS and Android.",
                    style: TextStyle(fontSize: 25, color: Colors.white),
                  )),
                  Image.asset(
                    'assets/images/zulkipar.jpeg',
                    width: mediaQueryWidth * 0.2,
                    height: mediaQueryHeight * 0.5,
                    fit: BoxFit.fill,
                  ),
                ],
              ),
            ),
            stars,
            const Padding(padding: EdgeInsets.all(16.0)),
          ],
        ),
      ),
    );
  }
}
