import 'package:flutter/material.dart';
import '../components/Navbar.dart';

class ExplorePage extends StatefulWidget {
  const ExplorePage({Key? key}) : super(key: key);
  @override
  // ignore: library_private_types_in_public_api
  _ExplorePageState createState() => _ExplorePageState();
}

class _ExplorePageState extends State<ExplorePage> {
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
              alignment: Alignment.center,
              padding: const EdgeInsets.all(10),
              child: const Text(
                'Our Family',
                style: TextStyle(
                    fontSize: 20,
                    // fontFamily: 'Inter',
                    fontWeight: FontWeight.w900,
                    color: Colors.white),
              ),
            ),
            Wrap(
              alignment: WrapAlignment.spaceAround,
              children: [
                Image.asset(
                  'assets/images/galih.jpeg',
                  width: 130,
                  height: mediaQueryHeight * 0.23,
                  fit: BoxFit.fill,
                ),
                Image.asset(
                  'assets/images/zulkipar.jpeg',
                  width: 130,
                  height: mediaQueryHeight * 0.23,
                  fit: BoxFit.fill,
                ),
                Image.asset(
                  'assets/images/paldy.jpeg',
                  width: 115,
                  height: mediaQueryHeight * 0.23,
                  fit: BoxFit.fill,
                ),
                Image.asset(
                  'assets/images/paldy.jpeg',
                  width: 115,
                  height: mediaQueryHeight * 0.23,
                  fit: BoxFit.fill,
                ),
              ],
            ),
            const Divider(
              height: 10,
            ),
            ElevatedButton(
              onPressed: () {
                Navigator.pushNamed(context, '/homepage');
              },
              style: ElevatedButton.styleFrom(
                minimumSize: const Size(0, 40),
                primary: Colors.amber,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12), // <-- Radius
                ),
              ),
              child: const Text('Back to Home'),
            ),
            const Padding(padding: EdgeInsets.all(16.0)),
          ],
        ),
      ),
    );
  }
}
