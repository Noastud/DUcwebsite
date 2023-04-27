with open('styles.css', 'r') as file:
    content = file.read()

properties = []
for line in content.split('\n'):
    if ':' in line:
        prop = line.split(':')[0].strip()
        if prop not in properties:
            properties.append(prop)

sorted_props = sorted(properties)

new_content = ''
for prop in sorted_props:
    for line in content.split('\n'):
        if line.startswith(prop):
            new_content += line + '\n'

with open('sorted_styles.css', 'w') as file:
    file.write(new_content)
