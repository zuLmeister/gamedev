import 'package:flutter/material.dart';

import '../../../components/check.dart';
import '../../../pdw.dart';
import '../../Signup/signup.dart';

class PassForm extends StatelessWidget {
  const PassForm({
    Key? key,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Form(
      child: Column(
        children: [
          Text(
            "Forgot Password".toUpperCase(),
            style: const TextStyle(
                height: 5,
                fontFamily: 'RobotoMono',
                color: Color.fromARGB(255, 252, 252, 252),
                fontWeight: FontWeight.w900),
          ),
          TextFormField(
            keyboardType: TextInputType.emailAddress,
            textInputAction: TextInputAction.next,
            cursorColor: kPrimaryColor,
            onSaved: (email) {},
            decoration: const InputDecoration(
              hintText: "Your email",
              prefixIcon: Padding(
                padding: const EdgeInsets.all(defaultPadding),
                child: Icon(Icons.person),
              ),
            ),
          ),
          const SizedBox(height: defaultPadding),
          Hero(
            tag: "login_btn",
            child: ElevatedButton(
              onPressed: () {
                Navigator.pushNamed(context, '/loginpage');
              },
              child: Text(
                "Kirim".toUpperCase(),
              ),
            ),
          ),
      ],
    ));
  }}
