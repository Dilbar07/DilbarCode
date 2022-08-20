#operators
#1
a=2534
a=a//10
print(a)
#2
a=2089
a=a%10
print(a)
#3
a,b=10,5
a=a+b
b=a-b
a=a-b
print("a=",a,"b=",b)
#4
x=int(input("enter your no="))
y=int(input("enter your no="))
print(x**y)
#5
x=int(input("enter your 3 digit number="))
x=x//10
y=x//10
print(y)
#6
x=int(input("enter your 3 digit number="))
x=x//10
y=x%10
print(y)
#7
x=int(input("enter your 3 digit number="))
x=x%10
print(x)
#8
s='My name is Dilbar'
print('name' in s)
#9
s='I Love India'
print('love'not in s)
a=ord('a')
b=97
print(a is b)
print(id(a),id(b))

