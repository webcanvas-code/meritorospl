import sys
sys.stdout.reconfigure(encoding='utf-8')

def parse_po(path):
    entries = {}
    cur_id = cur_str = None
    in_id = in_str = False
    for line in open(path, encoding='utf-8'):
        line = line.rstrip('\n')
        if line.startswith('msgid "'):
            if cur_id is not None and cur_str is not None:
                entries[cur_id] = cur_str
            cur_id = line[7:-1].replace('\\n', '\n').replace('\\"', '"')
            cur_str = None; in_id, in_str = True, False
        elif line.startswith('msgstr "'):
            cur_str = line[8:-1].replace('\\n', '\n').replace('\\"', '"')
            in_id, in_str = False, True
        elif line.startswith('"'):
            chunk = line[1:-1].replace('\\n', '\n').replace('\\"', '"')
            if in_id and cur_id is not None: cur_id += chunk
            elif in_str and cur_str is not None: cur_str += chunk
        elif line == '': in_id = in_str = False
    if cur_id is not None and cur_str is not None:
        entries[cur_id] = cur_str
    entries.pop('', None)
    return {k: v for k, v in entries.items() if v and k}

def php_escape(s):
    return s.replace('\\', '\\\\').replace("'", "\\'")

BASE = 'meritoros-theme/languages'
for lang, locale in [('en', 'en_US'), ('uk', 'uk'), ('ru', 'ru_RU')]:
    d = parse_po(f'{BASE}/{locale}.po')
    lines = ["<?php\nreturn [\n"]
    for k, v in d.items():
        lines.append(f"    '{php_escape(k)}' => '{php_escape(v)}',\n")
    lines.append("];\n")
    out = f'{BASE}/{lang}.php'
    with open(out, 'w', encoding='utf-8', newline='\n') as f:
        f.writelines(lines)
    print(f'Written {out} ({len(d)} entries)')
