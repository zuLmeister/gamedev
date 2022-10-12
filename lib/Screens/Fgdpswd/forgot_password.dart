import 'package:flutter/material.dart';
import 'package:gamedev/responsive.dart';
import '../../components/background.dart';
import 'components/form.dart';
import 'components/screen.dart';

class PassScreen extends StatelessWidget {
  const PassScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Background(
      child: SingleChildScrollView(
        child: Responsive(
          mobile: const MobilePassScreen(),
          desktop: Row(
            children: [
              const Expanded(
                child: PassScreenTopImage(),
              ),
              Expanded(
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: const [
                    SizedBox(
                      width: 450,
                      child: PassForm(),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class MobilePassScreen extends StatelessWidget {
  const MobilePassScreen({
    Key? key,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.center,
      children: <Widget>[
        const PassScreenTopImage(),
        Row(
          children: const [
            Spacer(),
            Expanded(
              flex: 8,
              child: PassForm(),
            ),
            Spacer(),
          ],
        ),
      ],
    );
  }
}
